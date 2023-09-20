FROM registry.access.redhat.com/ubi9/php-81@sha256:9f4bf8f9f9dc2a3d640478b4206e8e7b2ea6247db24d5f3c94b3ba40299d32d5

USER 0
RUN dnf install -y https://dl.fedoraproject.org/pub/epel/epel-release-latest-9.noarch.rpm
RUN dnf install -y php-fpm
RUN dnf install -y composer

RUN chown 1001:0 /var/run

# RUN cd /tmp ; composer create-project laravel/laravel:^8.0 /tmp/src
COPY /src /tmp/src
RUN chown -R 1001:0 /tmp/src

RUN /usr/libexec/s2i/assemble

USER 1001
ENV DOCUMENTROOT /public

CMD /usr/libexec/s2i/run
