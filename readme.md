# Introduction to Laravel

##Podmienky:
1. nainstalovany web server

##Instalacia:
1. [Composer](https://getcomposer.org/)
2. Nastavenie host:
  2.1 Spustenie textoveho editora (right click -> run ad Admin)
  2.2 Priecinok C:/Windows/System 32/drivers/etc/
  2.3 Selekcia vsetkych suborov, nie iba txt (priamo nad tlacidlom Open)
  2.4 Otvorenie hosts
  2.5 Na konci dokumentu pridajte 127.0.0.1		vasNazov.dev
3. Nastavenie vhost vo WAMP:
  3.1 Priecinok C:/wamp/vhosts
  3.2 Vytvorenie noveho suboru vasNazov (bez akejkolvek pripony)
  3.3 Vlozenie:
  ...
  <VirtualHost *:80>
  	ServerName laravel1.dev
  	DocumentRoot c:/wamp/www/laravel1/public
  	<Directory c:/wamp/www/laravel1/public>
  	  AllowOverride all
  	</directory>
  </VirtualHost>
  ...
4. Vytvorenie projektu:
  4.1 PhpStorm -> New project -> Project type = Composer project
  4.2 Filter packages = laravel/laravel; Version to install = default; Path to PHP executables = C:\wamp\bin\php\php5.5.12\php.exe (pripadne ina verzia PHP v priecinku pod C:\wamp\bin\php\)
5. Mozte pracovat ;)

#Homework
1. Stiahnite si tento repositar
2. Vytvorte login, registration, a logout funkcionalitu
  2.1 Nastavte routes podla [Laravel dokumentacie k autentifikacii](http://laravel.com/docs/5.1/authentication)
  2.2 Podla rovnakeho dokumentu vytvorte views pre login a registraciu
  3.3 Pri logine a registracii vyuzite master.blade layout
  3.4 Odchytavajte chybove hlasky.
  Snippet:
  ...
  	@if (count($errors) > 0)
			<div class="alert alert-danger">
				<strong></strong> There were some problems with your input.<br><br>
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
  ...
  3.5 Na adrese localhost/phpmyadmin vytvorte novu databazu
  3.6 Na rovnakom webe vytvorte noveho pouzivatela s globalnymi pravami (pozor, host zmente z defaultneho '%' na 'localhost')
  3.7 V .env subore nastavte pristup k databaze
