# Eseguire Il generatore in locale
Per eseguire il software è necessario installare docker e docker-compose. La versione docker CE è sufficente. [Per saperne di più](https://docs.docker.com/install/)

# Installazione.
Clonare il progetto.
```
git clone https://github.com/donateoa/healthland.git
```
Con windows impostare la variabile di ambiente
```
SET COMPOSE_CONVERT_WINDOWS_PATHS=1 
```

Fai partire i servizi.
```
cd healthland && docker-compose pull && docker-compose up
```

Attendere qualche minuto che il sistema sia tutto su e in stato running.
Le applicazioni organizzate in container sono le seguenti
1. ldap-admin: Interfaccia grafica WEB per gestire il repository LDAP
2. ldap-service: Servizio LDAP
3. humhub: Applicazione Healthland
4. survey-generator-postgresql: DB dei questionari
5. adminer: Interfaccia grafica WEB per gestire il database mySQL di Humhub
6. db: MYSQL di HumHub
7. survey-generator-app: Backed dei questionari
8. ionic-survey-generator-app: Applicazione Ionic per i questionari

I servizi sono disponibili ai seguenti link
1. [http://localhost:6443](http://localhost:6443/) - ldap-admin
2. [http://localhost:8090](http://localhost:8090/) - adminer
3. [http://localhost:85](http://localhost:85/dashboard) - humhub
4. [http://localhost:8087](http://localhost:8087/) - survey-generator-app
5. [http://localhost:8088](http://localhost:8088/#/login) - ionic-survey-generator-app

## Aggiungere Utenti e Profili

Aprire ldap-admin ed effettuare il login con: 
- user: cn=admin,dc=example,dc=org 
- pwd: admin

Se non ci sono aggiungere i seguenti profili 
- groupAdmin
- operatore
- users

Guida allo startup: [guida](./guide.pdf) 

# Terminare l'esecuzione 
per terminare l'esecuzione è sufficente chiudere il terminale o all'interno della finestra premere i tasti 'CTRL+C`.

# Come trasferire tutto lo stack su un altro server.
1. smontare tutti i containers. `docker-compose down`
2. eseguire il commit dei dati. `git add . && git commit -am "Add Backup data" && git push`
3. sul nuovo server eseguire il pull dei dati e lanciare i nuovi servizi con docker-compose. `git pull && docker-compose up -d`

# per installare i moduli
E' necessario fornire le grant di scrittura alla cartella
`/var/www/localhost/htdocs/protected/runtime/cache/hu/` del container.
