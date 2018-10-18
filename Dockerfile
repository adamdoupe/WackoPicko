FROM tutum/lamp
MAINTAINER Adam Doupe <adamdoupe@gmail.com>

RUN apt-get update && apt-get install -y libgd-dev php5-gd
RUN rm -fr /app
COPY website /app
RUN chmod 777 /app/upload

COPY current.sql .
ADD create_mysql_admin_user.sh /create_mysql_admin_user.sh
ADD php.ini /etc/php5/apache2/php.ini
ADD php.ini /etc/php5/cli/php.ini
RUN sed -i 's/150/250/g' /etc/apache2/mods-available/mpm_worker.conf
RUN sed -i 's/150/250/g' /etc/apache2/mods-available/mpm_prefork.conf
RUN chmod 755 /*.sh
