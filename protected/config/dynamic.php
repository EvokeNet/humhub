<?php return array (
  'components' => 
  array (
    'db' => 
    array (
      'class' => 'yii\\db\\Connection',
      'dsn' => 'mysql:host=localhost;dbname=humhub',
      'username' => 'root',
      'password' => '6907388',
      'charset' => 'utf8',
    ),
    'user' => 
    array (
    ),
    'mailer' => 
    array (
      'transport' => 
      array (
      ),
      'useFileTransport' => true,
      'view' => 
      array (
        'theme' => 
        array (
          'name' => 'Evoke',
          'basePath' => '/srv/www/humhub/themes/Evoke',
        ),
      ),
    ),
    'view' => 
    array (
      'theme' => 
      array (
        'name' => 'Evoke',
        'basePath' => '/srv/www/humhub/themes/Evoke',
      ),
    ),
    'formatter' => 
    array (
      'defaultTimeZone' => 'America/Sao_Paulo',
    ),
    'formatterApp' => 
    array (
      'defaultTimeZone' => 'America/Sao_Paulo',
      'timeZone' => 'America/Sao_Paulo',
    ),
  ),
  'params' => 
  array (
    'installer' => 
    array (
      'db' => 
      array (
        'installer_hostname' => 'localhost',
        'installer_database' => 'humhub',
      ),
    ),
    'settings' => 
    array (
      'core' => 
      array (
        'colorDefault' => '#3C454D',
        'colorPrimary' => '#708fa0',
        'colorInfo' => '#6fdbe8',
        'colorSuccess' => '#97d271',
        'colorWarning' => '#fdd198',
        'colorDanger' => '#ff8989',
        'oembedProviders' => '{"vimeo.com":"http:\\/\\/vimeo.com\\/api\\/oembed.json?scheme=https&url=%url%&format=json&maxwidth=450","youtube.com":"http:\\/\\/www.youtube.com\\/oembed?scheme=https&url=%url%&format=json&maxwidth=450","youtu.be":"http:\\/\\/www.youtube.com\\/oembed?scheme=https&url=%url%&format=json&maxwidth=450","soundcloud.com":"https:\\/\\/soundcloud.com\\/oembed?url=%url%&format=json&maxwidth=450","slideshare.net":"https:\\/\\/www.slideshare.net\\/api\\/oembed\\/2?url=%url%&format=json&maxwidth=450"}',
        'name' => 'Evoke',
        'baseUrl' => 'http://192.168.1.37/humhub',
        'paginationSize' => '10',
        'displayNameFormat' => '{profile.firstname} {profile.lastname}',
        'theme' => 'Evoke',
        'defaultLanguage' => 'es',
        'useCase' => 'other',
        'secret' => '7affb751-0cd0-4cd0-bf31-87b6a141835a',
        'timeZone' => 'America/Sao_Paulo',
      ),
      'space' => 
      array (
        'defaultVisibility' => '1',
        'defaultJoinPolicy' => '1',
        'spaceOrder' => '0',
      ),
      'authentication' => 
      array (
        'authInternal' => '1',
        'authLdap' => '0',
      ),
      'authentication_ldap' => 
      array (
        'refreshUsers' => '1',
      ),
      'authentication_internal' => 
      array (
        'needApproval' => '0',
        'anonymousRegistration' => '1',
        'internalUsersCanInvite' => '1',
      ),
      'mailing' => 
      array (
        'transportType' => 'file',
        'systemEmailAddress' => 'social@example.com',
        'systemEmailName' => 'HumHub',
        'receive_email_activities' => '1',
        'receive_email_notifications' => '2',
        'hostname' => '',
        'username' => '',
        'password' => '',
        'port' => '',
        'encryption' => '',
        'allowSelfSignedCerts' => '0',
      ),
      'file' => 
      array (
        'maxFileSize' => '1048576',
        'maxPreviewImageWidth' => '200',
        'maxPreviewImageHeight' => '200',
        'hideImageFileInfo' => '0',
      ),
      'cache' => 
      array (
        'type' => 'CFileCache',
        'expireTime' => '3600',
      ),
      'admin' => 
      array (
        'installationId' => '04345044caca98e78559a440afd42b0d',
        'defaultDateInputFormat' => '',
      ),
      'tour' => 
      array (
        'enable' => '1',
      ),
      'share' => 
      array (
        'enable' => '1',
      ),
      'notification' => 
      array (
        'enable_html5_desktop_notifications' => '0',
      ),
      'installer' => 
      array (
        'sampleData' => '1',
      ),
      'dashboard' => 
      array (
        'showProfilePostForm' => '0',
      ),
      'birthday' => 
      array (
        'shownDays' => '2',
      ),
    ),
    'config_created_at' => 1462565797,
    'databaseInstalled' => true,
    'installed' => true,
  ),
  'name' => 'Evoke',
  'language' => 'es',
  'timeZone' => 'America/Sao_Paulo',
); 

?>