<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RecruitResource\Pages;
use App\Models\Company;
use App\Models\Prefecture;
use App\Models\Recruit;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
// use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class RecruitResource extends Resource
{
	protected static ?string $model = Recruit::class;

	protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

	public static function form(Form $form): Form
	{
		return $form

			->schema([
				Section::make()->schema([
					TextInput::make('name')
						->required()
						->maxLength(255),
					DatePicker::make('start_date'),
					DatePicker::make('end_date'),
					Select::make('prefecture_id')
						->label('Prefectures')
						->options(Prefecture::all()->pluck('name', 'id'))
						->searchable()
						->live(),
					Select::make('company_id')
						->options(fn (Get $get): Collection => Company::query()
							->where('prefecture_id', $get('prefecture_id'))
							->pluck('name', 'id'))
					// Forms\Components\Select::make('prefecture_id')
					// 	->relationship('prefecture', 'name')
					// 	->required(),
				])->columns(2),
				Section::make('Images')
					->schema([
						SpatieMediaLibraryFileUpload::make('media')
							->disk('s3')
							->collection('product-images')
							->multiple()
							->maxFiles(5)
							->hiddenLabel(),
					])
					->collapsible(),
			]);
	}

	public static function table(Table $table): Table
	{
		return $table
			->columns([
				Tables\Columns\TextColumn::make('name')
					->searchable(),
				Tables\Columns\TextColumn::make('start_date')
					->date()
					->sortable(),
				Tables\Columns\TextColumn::make('end_date')
					->date()
					->sortable(),
				Tables\Columns\TextColumn::make('company.name')
					->numeric()
					->sortable(),
				Tables\Columns\TextColumn::make('created_at')
					->dateTime()
					->sortable()
					->toggleable(isToggledHiddenByDefault: true),
				Tables\Columns\TextColumn::make('updated_at')
					->dateTime()
					->sortable()
					->toggleable(isToggledHiddenByDefault: true),
			])
			->filters([
				Filter::make('filter')
					->form([
						DatePicker::make(__('start_date')),
						DatePicker::make('end_date'),
						Select::make('company_id')
							->relationship('company', 'name')
							->searchable()
							->preload()
							->placeholder('all')
					])
					->columns(3)
					->query(function (Builder $query, array $data): Builder {
						return $query
							->when(
								$data['start_date'],
								fn (Builder $query, $date): Builder => $query->whereDate('start_date', '>=', $date),
							)
							->when(
								$data['end_date'],
								fn (Builder $query, $date): Builder => $query->whereDate('end_date', '<=', $date),
							)
							->when(
								$data['company_id'],
								fn (Builder $query, $companyId): Builder => $query->where('company_id', $companyId),
							);
					}),
				// SelectFilter::make('company')
				// 	->relationship('company', 'name')
				// 	->searchable()
				// 	->preload()
				// 	->placeholder('')
				// 	->columns(2)
			], layout: FiltersLayout::AboveContent)
			->filtersFormColumns(1)
			->deferFilters()
			->filtersApplyAction(
				fn (Action $action) => $action
					->button()
					->label(__('Search')),
			)
			->actions([
				Tables\Actions\ViewAction::make(),
				Tables\Actions\EditAction::make(),
			])
			->bulkActions([
				Tables\Actions\BulkActionGroup::make([
					Tables\Actions\DeleteBulkAction::make(),
				]),
			]);
	}

	public static function getRelations(): array
	{
		return [
			//
		];
	}

	public static function getPages(): array
	{
		return [
			'index' => Pages\ListRecruits::route('/'),
			'create' => Pages\CreateRecruit::route('/create'),
			'edit' => Pages\EditRecruit::route('/{record}/edit'),
		];
	}
}
