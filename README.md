Instrukcja:
Aplikacja ta korzysta z bazy danych mysql wiec wystarczy na windowsie nawet xampp by odpalic go na lokalnym serwerze. 
W takim wypadku w konfiguracji apache w sekcji Document root ustawiamy sciezke do pliku public.
Zrobiłem export bazy danych wiec wchodząc w localhost/phpmyadmin po prostu importujemy plik beer_table.sql. Credentials sa domyslne co można podpatrzec w pliku sys/dbcred.php

Na ubuntu apache jest juz domyslnie zainstalowany wiec wystarczy pobrac paczki mysql i phpmyadmin, zainstalowac i odpowednio skonfigurowac.
