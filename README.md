Prez Project in Symfony 2
========================
[![Gitter](https://badges.gitter.im/Join Chat.svg)](https://gitter.im/Symfomany/prez?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

[![Build Status](https://travis-ci.org/Symfomany/prez.svg?branch=master)](https://travis-ci.org/Symfomany/prez)
![Project Status](http://stillmaintained.com/Symfomany/prez.png)

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Symfomany/prez/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Symfomany/prez/?branch=master)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/df27ca15-3f18-4fd3-9467-85b42aecbfc3/big.png)](https://insight.sensiolabs.com/account/widget?project=df27ca15-3f18-4fd3-9467-85b42aecbfc3)


Projet d'apprentissage Symfony 2 pour Presentation by Boyer Julien

Presentation of Symfony 2 by Boyer Julien
========================

[Presentation de Symfony 2](https://slides.com/julienboyer/symfony-2 " Presentation de Symfony 2")


1) Installing the Standard Edition
----------------------------------

### Use Composer (*recommended*)


  - curl -s http://getcomposer.org/installer | php --
  - php composer.phar install --dev
  - php app/console doctrine:database:drop --force
  - php app/console doctrine:database:create
  - php app/console doctrine:schema:update --force


### Download an Archive File

To quickly test App in SYmfony 2, you can also download an [archive][3] of the Standard
Edition and unpack it somewhere under your web server root directory.

If you downloaded an archive "without vendors", you also need to install all
the necessary dependencies. Download composer (see above) and run the
following command:

    php composer.phar install


2) Testing my app
-------------------------------
 phpunit -c app/

2) Loading datas
-------------------------------
 php app/console doctrine:fixtures:load

3) View documentation
-------------------------------
 /docs/api/index.html

