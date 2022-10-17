FROM mysql
# Copy content from .sql to Docker mysql container
COPY ./trophies.sql /docker-entrypoint-initdb.d/init.sql
EXPOSE 3306