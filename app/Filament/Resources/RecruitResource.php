<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RecruitResource\Pages;
use App\Models\Company;
use App\Models\Prefecture;
use App\Models\Recruit;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class RecruitResource extends Resource
{
	protected static ?string $model = Recruit::class;

	protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

	public static function form(Form $form): Form
	{
		return $form

			->schema([
				Section::make()->schema([
					TextInput::make('title')
						->required()
						->maxLength(255),
					Textarea::make('description')
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
							->pluck('name', 'id'))
						->searchable()
						->live(),

				])->columns(2),
				Section::make()->schema([
					CheckboxList::make('shokushuItems')
						->label('Shokushu items')
						->relationship('shokushuItems', 'name')
						->columns(4)
				])
			]);
	}

	public static function table(Table $table): Table
	{
		return $table
			->columns([
				TextColumn::make('title')
					->searchable()
					->sortable(),
				TextColumn::make('description')
					->searchable()
					->sortable()
					->toggleable(isToggledHiddenByDefault: true),
				TextColumn::make('start_date')
					->date()
					->sortable(),
				TextColumn::make('end_date')
					->date()
					->sortable(),
				TextColumn::make('company.name')
					->numeric()
					->sortable(),
				TextColumn::make('prefecture.name')
					->numeric()
					->sortable(),
				TextColumn::make('created_at')
					->dateTime()
					->sortable()
					->toggleable(isToggledHiddenByDefault: true),
				TextColumn::make('updated_at')
					->dateTime()
					->sortable()
					->toggleable(isToggledHiddenByDefault: true),
			])
			->filters([
				Filter::make('filter')
					->form([
						Select::make('company_id')
							->relationship('company', 'name')
							->searchable()
							->preload()
							->placeholder('all'),
						Select::make('prefecture_id')
							->relationship('prefecture', 'name')
							->searchable()
							->preload()
							->placeholder('all'),
						Select::make('shokushuItems')
							->searchable()
							->preload()
							->multiple()
							->relationship('shokushuItems', 'name'),
						TextInput::make('title'),
						TextInput::make('description'),
						DatePicker::make(__('start_date')),
						DatePicker::make('end_date'),
					])
					->columns(2)
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
							)
							->when(
								$data['title'],
								fn (Builder $query, $title): Builder => $query->where('title', 'LIKE', "%$title%")
							)
							->when(
								$data['description'],
								fn (Builder $query, $description): Builder => $query->where('description', 'LIKE', "%$description%")
							)
							->when(
								$data['shokushuItems'],
								fn (Builder $query, $shokushuItemIds): Builder => $query->whereHas('shokushuItems', function (Builder $query) use ($shokushuItemIds) {
									$query->whereIn('shokushu_item_id', $shokushuItemIds);
								})
							);
					}),
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
					ExportBulkAction::make()->exports([
						ExcelExport::make()->fromTable()->queue()
					]),
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
