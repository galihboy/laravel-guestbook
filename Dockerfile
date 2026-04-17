FROM php:8.2-apache

# Update repo dan install dependencies yang dibutuhkan
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    && rm -rf /var/lib/apt/lists/*

# Install ekstensi PHP untuk PostgreSQL (pdo_pgsql) DAN MySQL (pdo_mysql)
# Ini memungkinkan Laravel berjalan dengan database apapun yang dikonfigurasi di ENV
RUN docker-php-ext-install pdo_mysql pdo_pgsql zip

# Aktifkan mod_rewrite Apache untuk URL Laravel yang bersih
RUN a2enmod rewrite

# Install Composer
COPY --from=composer:2.7.6 /usr/bin/composer /usr/bin/composer

# Atur working directory di dalam container
WORKDIR /var/www/html

# Salin semua file proyek (kecuali yang ada di .dockerignore)
COPY . .

# Install dependensi Laravel (tanpa dev package)
RUN composer install --no-dev --optimize-autoloader

# Salin script start.sh, bersihkan carriage return (jika diedit di Windows), lalu beri hak akses eksekusi
COPY start.sh /usr/local/bin/start.sh
RUN sed -i 's/\r$//' /usr/local/bin/start.sh && \
    chmod +x /usr/local/bin/start.sh

# Atur hak akses folder Laravel (Storage dan Cache butuh akses tulis)
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Ubah DocumentRoot Apache agar mengarah ke folder public Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Buka port 80 (Koyeb akan otomatis membaca port ini)
EXPOSE 80

# Gunakan start.sh sebagai perintah utama saat container menyala
CMD ["/usr/local/bin/start.sh"]
