FROM scaleinfinite/php-nginx


COPY /INGC_CRM /var/www/html
COPY /media_root /var/www/media_root/qr_codes
# Configure nginx
COPY config/nginx.conf /etc/nginx/nginx.conf

# Configure supervisord
COPY config/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

USER root
RUN chown -R nobody ./authentication/
RUN chown nobody db.sqlite3
RUN chown -R nobody /var/www/media_root/qr_codes
RUN apk add --no-cache \
  python3 \
  py3-pip


RUN pip install -r requirements.txt 
USER nobody

EXPOSE 80
EXPOSE 8000
#ENTRYPOINT ["python3"]
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]