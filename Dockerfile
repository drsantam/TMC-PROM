FROM drupal:latest

# Install packages
RUN rm /bin/sh && ln -s /bin/bash /bin/sh && \
    apt-get update && apt-get install --no-install-recommends -y \
    curl \
    wget \
    nano \
    git \
    unzip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer && \
    ln -s /root/.composer/vendor/bin/drush /usr/local/bin/drush

# Install Drush
RUN composer global require drush/drush && \
    composer global update

# Clean repository
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install composer merge plugin 
RUN composer config --no-plugins allow-plugins.wikimedia/composer-merge-plugin true

RUN composer require wikimedia/composer-merge-plugin

# Modify composer.json

# Install contributed modules

RUN composer require 'drupal/webform:^6.2@beta' # To provide webform functionality
RUN composer require 'drupal/charts:^5.0' # To make charts
RUN composer require 'drupal/dropdown_language:^4.0' # To add a better dropdown language selector
RUN composer require 'drupal/entity:^1.4' 
RUN composer require 'drupal/entity_print:^2.13' # To add an print PDF option for webform
RUN composer require 'drupal/paragraphs:^1.15' # To create custom content 
RUN composer require 'drupal/smtp:^1.2' # To send emails via sendinblue
RUN composer require 'drupal/group:^3.1' # To enable group feature
RUN composer require 'drupal/viewsreference:^2.0@beta' # Add views reference field
RUN composer require 'drupal/views_add_button:^2.0' # To create the add patient functionality in group pages
# RUN composer require 'drupal/views_add_button_group:^2.0' # To create add patient functionality in group pages.
RUN composer require 'drupal/webform_views:^5.1' # To add functionality of webform with views
RUN composer require 'drupal/role_delegation:^1.2' # To ensure doctors and coordinators can assign roles to patients
RUN composer require 'drupal/super_login:^2.1' # To use superlogin with drupal 
RUN composer require 'drupal/login_redirect_per_role:^1.9' # To ensure patients are redirected to the correct page after logging in
RUN composer require 'drupal/token:^1.12' # Install token module
RUN composer require 'drupal/masquerade:^2.0@RC' # To install masquarade module
RUN composer require 'drupal/webform_content_creator:^4.0' # Allows creating content entities from webform submission.
