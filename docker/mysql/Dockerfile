FROM mysql:8.0
COPY ./app/sql/db.sql /docker-entrypoint-initdb.d/db.sql
COPY ./my.cnf /etc/mysql/conf.d/my.cnf:ro