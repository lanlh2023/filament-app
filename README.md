# Research: building filamnent page
# Set up Develop
## Packe required 
docker-sail、docker-compose, Laravel(^10.10), filament/filament(^3.2), vuejs(^2.6.12),flowframe/laravel-trend(^0.2.0), league/flysystem-aws-s3-v3(^3.0), filament/spatie-laravel-media-library-plugin(3.2),...
## Execute only once when building the development environment
- `composer install`
- `alias sail='sh $([ -f sail ] && echo sail || echo vendor/bin/sail)'`
- `sail up -d`
- `sail artisan migrate --seed`
## List of feature
- [X] Login, logout Page.
- [X] Notifications.
- [X] Manage Company: CRUD. 
- [X] Manage Recruit: CRUD. 
- [X] Search and export csv Recruit.
## Images of feature
# Home
![image](https://github.com/lanlh2023/filament-app/assets/147787873/db5bc7b9-a6e3-4457-a738-0c52ac606758)
# Admin notification
![image](https://github.com/lanlh2023/filament-app/assets/147787873/05aa48ed-7b5b-45e8-a3bf-a006ed5ff853)
![image](https://github.com/lanlh2023/filament-app/assets/147787873/eb68ae18-b619-4706-9697-5e607fe1ffc1)
# Recruit
![image](https://github.com/lanlh2023/filament-app/assets/147787873/ba444b8d-86db-409c-8352-8757b16bfbfd)
![image](https://github.com/lanlh2023/filament-app/assets/147787873/85138d41-3104-41be-8a32-372586c078ce)
![image](https://github.com/lanlh2023/filament-app/assets/147787873/d22a784f-864c-434b-87d8-d1c2aef5d161)
![image](https://github.com/lanlh2023/filament-app/assets/147787873/1135e3cd-0ea2-441c-ab9b-22a1d4c8d872)
![image](https://github.com/lanlh2023/filament-app/assets/147787873/ca1c74eb-dd1c-4565-862e-9c5808396cbd)


