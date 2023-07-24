# We will use the official docker image which is based on debian slim and uses php 8.2. Drupal version 10.1 is used. Version changes can be specified.
FROM drupal:10.1

# Install packages
RUN rm /bin/sh && ln -s /bin/bash /bin/sh && \
    apt-get update && apt-get install --no-install-recommends -y \
    curl \
    build-essential \
    wget \
    nano \
    git \
    unzip
# Install php extensions
RUN pecl install apcu
RUN pecl install uploadprogress
# Enable apcu
RUN docker-php-ext-enable apcu
RUN docker-php-ext-enable uploadprogress

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer && \
    ln -s /root/.composer/vendor/bin/drush /usr/local/bin/drush
# Install Drupal Console
RUN curl https://drupalconsole.com/installer -L -o drupal.phar \
    && mv drupal.phar /usr/local/bin/drupal \
    && chmod +x /usr/local/bin/drupal    

# Install Drush
RUN composer require drush/drush && \
    composer update

# Clean repository
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install composer merge plugin 
RUN composer config --no-plugins allow-plugins.wikimedia/composer-merge-plugin true

RUN composer require wikimedia/composer-merge-plugin

# Modify composer.json

# set recommended PHP.ini settings
# see https://secure.php.net/manual/en/opcache.installation.php
RUN { \
		echo 'opcache.memory_consumption=128'; \
		echo 'opcache.interned_strings_buffer=8'; \
		echo 'opcache.max_accelerated_files=4000'; \
		echo 'opcache.revalidate_freq=60'; \
		echo 'opcache.fast_shutdown=1'; \
		echo 'opcache.enable_cli=1'; \
	} > /usr/local/etc/php/conf.d/opcache-recommended.ini

RUN { \
		echo 'realpath_cache_size = 256k'; \
		echo 'memory_limit = 512M'; \
		echo 'upload_max_filesize = 50M'; \
		echo 'post_max_size = 50M'; \
		echo 'max_execution_time = 360'; \  
	} >  /usr/local/etc/php/conf.d/my.ini

#RUN mkdir -p /var/lib/php/session

#RUN chown -R www-data:www-data /var/lib/php/session

# Install contributed modules

RUN composer require 'drupal/auto_entitylabel:^3.0' # Allow creation of automatic node titles. 
RUN composer require 'drupal/token:^1.12' # Install token module
RUN composer require 'drupal/profile:^1.7' # Allow creation of patient profiles
RUN composer require 'drupal/webform:^6.2@beta' # To provide webform functionality
RUN composer require 'drupal/webform_content_creator:^4.0' # Allows creating content entities from webform submission.
RUN composer require 'drupal/webform_entity_handler:^2.0' # Alternative to webform content creator which allows creation of entitites instead of node content only. 
RUN composer require 'drupal/dropdown_language:^4.0' # To add a better dropdown language selector
RUN composer require 'drupal/entity:^1.4' 
RUN composer require 'drupal/entity_print:^2.13' # To add an print PDF option for webform
RUN composer require 'drupal/paragraphs:^1.15' # To create custom content 
RUN composer require 'drupal/layout_paragraphs:^2.0' # To use layout builder with paragraphs
RUN composer require 'drupal/group:^3.1' # To enable group feature
RUN composer require 'drupal/charts:^5.0' # To make charts
RUN composer require 'drupal/viewsreference:^2.0@beta' # Add views reference field
RUN composer require 'drupal/views_flipped_table:^2.0' # Create flipped tables for longitudinal patient data.
RUN composer require 'drupal/views_add_button:^2.0' # To create the add patient functionality in group pages
# RUN composer require 'drupal/views_add_button_group:^2.0' # To create add patient functionality in group pages.
RUN composer require 'drupal/webform_views:^5.1' # To add functionality of webform with views
RUN composer require 'drupal/role_delegation:^1.2' # To ensure doctors and coordinators can assign roles to patients
RUN composer require 'drupal/super_login:^2.1' # To use superlogin with drupal 
RUN composer require 'drupal/login_redirect_per_role:^1.9' # To ensure patients are redirected to the correct page after logging in
RUN composer require 'drupal/pathauto:^1.11' # Install pathauto to ensure that readable paths are present. 
RUN composer require 'drupal/masquerade:^2.0@RC' # To install masquarade module
RUN composer require 'drupal/password_policy:^4.0' # Secure password check and automatic password expiration
RUN composer require 'drupal/views_autocomplete_filters:^1.4' # Add autocomplete filter support for views filter to filter by usernames
RUN composer require 'drupal/views_conditional:^1.5' # Allow creating conditonal statements in Views
RUN composer require 'drupal/views_exposed_filter_blocks:^1.3' # Allows views exposed filters to be placed in blocks in layout manager
RUN composer require 'drupal/views_aggregator:^2.0' # Advanced aggregation on Views results
RUN composer require 'drupal/config_translation_po:^1.0' # To allow configuration translations to be done 
RUN composer require 'drupal/clientside_validation:^4.0' # To allow use of webform cards
RUN composer require 'drupal/permissions_by_term:^3.1' # To setup an alternate form of permissions using taxonomy terms. 
RUN composer require 'drupal/views_bulk_operations:^4.2' # Allow bulk operations on Views 
RUN composer require 'drupal/administerusersbyrole:^3.4' # Allows provision of create user and edit user to specific roles for the site. 
RUN composer require 'drupal/tmgmt:^1.15' # Translation management tool allowing users to translate content
RUN composer require 'drupal/config_translation_po:^1.0' # Allow configuration translattions to be downloaded and translated
RUN composer require 'drupal/webform_translation_permissions:^2.0' # Allows webform to be translated by users through additional permission without granting them permission to translate configuration.
RUN composer require 'drupal/dashboards:^2.1' # Allow creation of dashboards for the user. 
RUN composer require 'drupal/eca:^1.1' # Alternative for rules based triggering of action for D10
## Following Modules are related to the security and encryption of data. Please enable if required. 
RUN composer require 'drupal/field_encrypt:^3.1' # Allows Field data to be encrypted. Can be used to encrypt patient UID, email addressses etc. However one critical point to note is that encrypted fields cannot be used in Views. 
RUN composer require 'drupal/encrypt:^3.1' # Core encrypt module
RUN composer require 'drupal/sodium:^2.4' # Symmetric encryption using the libsodium PHP library
RUN composer require 'drupal/key:^1.17' # Allows creation and storage of sensitive Keys
## Mail system modules for sending emails. 
RUN composer require 'drupal/smtp:^1.2' # To send emails via sendinblue or other SMTP service. 
RUN composer require 'drupal/mailsystem:^4.4' # Drupal Mailsystem Module
RUN composer require 'drupal/phpmailer_smtp:^2.2' # Alternative system to send mails through SMTP. Can use the Key module to store the password as a secure Key instead of a plaintext password as done in SMTP authentication module. 
RUN composer require 'drupal/node_view_permissions:^1.6' # Ensure that nodes view permissions are restricted. 
RUN composer require 'drupal/redirect:^1.8' # Ensure that aliased paths are properly redirected.
RUN composer require 'drupal/entity_access_by_reference_field:^1.0' # Alternative permission control module. This did not work well. 
RUN composer require 'drupal/entity_access_by_role_field:^2.0' # To restrict viewing content of specific types on site. 
# Add a permission to the directory to enable writing to the same. 
RUN chown -R www-data:www-data /opt/drupal/web
