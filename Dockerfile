# WordPress for Google Cloud Run
FROM wordpress:latest

# Install Cloud SQL proxy
RUN curl -o /cloud_sql_proxy https://dl.google.com/cloudsql/cloud_sql_proxy.linux.amd64 \
    && chmod +x /cloud_sql_proxy

    # Configure Apache for Cloud Run (port 8080)
    RUN sed -i 's/Listen 80/Listen 8080/g' /etc/apache2/ports.conf \
        && sed -i 's/:80>/:8080>/g' /etc/apache2/sites-available/000-default.conf

        # Copy custom wp-config.php
        COPY wp-config.php /var/www/html/wp-config.php

        # Set environment variables for Cloud Run
        ENV APACHE_RUN_USER=www-data
        ENV APACHE_RUN_GROUP=www-data
        ENV APACHE_LOG_DIR=/var/log/apache2

        # Expose port 8080 (required by Cloud Run)
        EXPOSE 8080

        # Add startup script to handle Cloud SQL proxy
        RUN echo '#!/bin/bash\n\
        if [ -n "$CLOUDSQL_INSTANCE" ]; then\n\
            /cloud_sql_proxy -instances=$CLOUDSQL_INSTANCE=tcp:3306 &\n\
            fi\n\
            exec apache2-foreground' > /usr/local/bin/startup.sh \
                && chmod +x /usr/local/bin/startup.sh

                # Use the startup script
                CMD ["/usr/local/bin/startup.sh"]
