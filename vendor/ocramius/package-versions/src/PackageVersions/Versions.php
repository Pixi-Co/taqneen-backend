<?php

declare(strict_types=1);

namespace PackageVersions;

use OutOfBoundsException;

/**
 * This class is generated by ocramius/package-versions, specifically by
 * @see \PackageVersions\Installer
 *
 * This file is overwritten at every run of `composer install` or `composer update`.
 */
final class Versions
{
    public const ROOT_PACKAGE_NAME = 'laravel/laravel';
    /**
     * Array of all available composer packages.
     * Dont read this array from your calling code, but use the \PackageVersions\Versions::getVersion() method instead.
     *
     * @var array<string, string>
     * @internal
     */
    public const VERSIONS          = array (
  'aloha/twilio' => '4.0.4@d4174bbcb8caa41188088612f672677a0d3a3321',
  'anahkiasen/underscore-php' => '2.0.0@48f97b295c82d99c1fe10d8b0684c43f051b5580',
  'arcanedev/log-viewer' => '4.7.3@bb7bbce12d6220edff8bb4a2e45d1210cb4e08b6',
  'arcanedev/support' => '4.5.0@2bb6e901404a12caa440520676b6507569d20715',
  'automattic/woocommerce' => '3.1.0@d3b292f04c0b3b21dced691ebad8be073a83b4ad',
  'balping/json-raw-encoder' => 'v1.0.1@e2b0ab888342b0716f1f0628e2fa13b345c5f276',
  'barryvdh/laravel-dompdf' => 'v0.8.7@30310e0a675462bf2aa9d448c8dcbf57fbcc517d',
  'buglinjo/laravel-webp' => 'v2.3.1@8d28bad5dbb82d7257eb77f27b5c57daa0c0d6b8',
  'composer/semver' => '1.7.2@647490bbcaf7fc4891c58f47b825eb99d19c377a',
  'consoletvs/charts' => '6.5.6@fc73038a006ddc2d6b277b9567ee01c6272448b3',
  'defuse/php-encryption' => 'v2.3.1@77880488b9954b7884c25555c2a0ea9e7053f9d2',
  'dnoegel/php-xdg-base-dir' => 'v0.1.1@8f8a6e48c5ecb0f991c2fdcf5f154a47d85f9ffd',
  'doctrine/cache' => '2.1.1@331b4d5dbaeab3827976273e9356b3b453c300ce',
  'doctrine/dbal' => '2.13.8@dc9b3c3c8592c935a6e590441f9abc0f9eba335b',
  'doctrine/deprecations' => 'v0.5.3@9504165960a1f83cc1480e2be1dd0a0478561314',
  'doctrine/event-manager' => '1.1.1@41370af6a30faa9dc0368c4a6814d596e81aba7f',
  'doctrine/inflector' => '1.4.4@4bd5c1cdfcd00e9e2d8c484f79150f67e5d355d9',
  'doctrine/lexer' => '1.2.3@c268e882d4dbdd85e36e4ad69e02dc284f89d229',
  'dompdf/dompdf' => 'v0.8.6@db91d81866c69a42dad1d2926f61515a1e3f42c5',
  'dragonmantank/cron-expression' => 'v2.3.1@65b2d8ee1f10915efb3b55597da3404f096acba2',
  'egulias/email-validator' => '2.1.25@0dbf5d78455d4d6a41d186da50adc1122ec066f4',
  'erusev/parsedown' => '1.7.4@cb17b6477dfff935958ba01325f2e8a2bfa6dab3',
  'ezyang/htmlpurifier' => 'v4.14.0@12ab42bd6e742c70c0a52f7b82477fcd44e64b75',
  'fideloper/proxy' => '4.4.1@c073b2bd04d1c90e04dc1b787662b558dd65ade0',
  'firebase/php-jwt' => 'v5.5.1@83b609028194aa042ea33b5af2d41a7427de80e6',
  'giggsey/libphonenumber-for-php' => '8.12.47.1@dc6bce9772404a4e4fd48ec30310f51e1b5f027f',
  'giggsey/locale' => '2.2@9c1dca769253f6a3e81f9a5c167f53b6a54ab635',
  'graham-campbell/guzzle-factory' => 'v3.0.4@618cf7220b177c6d9939a36331df937739ffc596',
  'guzzlehttp/guzzle' => '6.5.5@9d4290de1cfd701f38099ef7e183b64b4b7b0c5e',
  'guzzlehttp/promises' => '1.5.1@fe752aedc9fd8fcca3fe7ad05d419d32998a06da',
  'guzzlehttp/psr7' => '1.8.5@337e3ad8e5716c15f9657bd214d16cc5e69df268',
  'intervention/image' => '2.7.1@744ebba495319501b873a4e48787759c72e3fb8c',
  'knox/pesapal' => '1.4.3@db78c66ddc21697f5a4942c5614489684b16bd73',
  'laravel/framework' => 'v5.8.38@78eb4dabcc03e189620c16f436358d41d31ae11f',
  'laravel/passport' => 'v7.5.1@d63cdd672c3d65b3c35b73d0ef13a9dbfcb71c08',
  'laravel/tinker' => 'v1.0.10@ad571aacbac1539c30d480908f9d0c9614eaf1a7',
  'laravelcollective/html' => 'v5.8.1@3a1c9974ea629eed96e101a24e3852ced382eb29',
  'lcobucci/jwt' => '3.4.6@3ef8657a78278dfeae7707d51747251db4176240',
  'league/event' => '2.2.0@d2cc124cf9a3fab2bb4ff963307f60361ce4d119',
  'league/flysystem' => '1.1.9@094defdb4a7001845300334e7c1ee2335925ef99',
  'league/mime-type-detection' => '1.11.0@ff6248ea87a9f116e78edd6002e39e5128a0d4dd',
  'league/oauth2-server' => '7.4.0@2eb1cf79e59d807d89c256e7ac5e2bf8bdbd4acf',
  'maatwebsite/excel' => '3.1.39@5165334de44c6f7788a5818a1d019aa71a43e092',
  'maennchen/zipstream-php' => '2.1.0@c4c5803cc1f93df3d2448478ef79394a5981cc58',
  'mailjet/mailjet-apiv3-php' => 'v1.5.1@7b94fa629d46fa5ba3826ed4596674942944520d',
  'markbaker/complex' => '3.0.1@ab8bc271e404909db09ff2d5ffa1e538085c0f22',
  'markbaker/matrix' => '3.0.0@c66aefcafb4f6c269510e9ac46b82619a904c576',
  'milon/barcode' => '6.0.5@06d4fc0cb50737942637b362ef0b61e20fd2d5bf',
  'monolog/monolog' => '1.27.0@52ebd235c1f7e0d5e1b16464b695a28335f8e44a',
  'mpdf/mpdf' => 'v8.1.1@e511e89a66bdb066e3fbf352f00f4734d5064cbf',
  'myclabs/deep-copy' => '1.11.0@14daed4296fae74d9e3201d2c4925d1acb7aa614',
  'myclabs/php-enum' => '1.8.3@b942d263c641ddb5190929ff840c68f78713e937',
  'nesbot/carbon' => '2.57.0@4a54375c21eea4811dbd1149fe6b246517554e78',
  'nexmo/laravel' => '2.4.1@029bdc19fc58cd6ef0aa75c7041d82b9d9dc61bd',
  'nikic/php-parser' => 'v4.13.2@210577fe3cf7badcc5814d99455df46564f3c077',
  'niklasravnsborg/laravel-pdf' => 'v4.1.0@a5f5c22dd5e10d8f536102cec01c21282e18ebae',
  'nwidart/laravel-menus' => '4.0.0@e6a97cfa704bc9b93f4a06ad9184fa65fe6120fc',
  'nwidart/laravel-modules' => '5.1.0@d4edc3465d471644ca44b1b303803492609957cd',
  'ocramius/package-versions' => '1.9.0@94c9d42a466c57f91390cdd49c81313264f49d85',
  'opis/closure' => '3.6.3@3d81e4309d2a927abbe66df935f4bb60082805ad',
  'paragonie/random_compat' => 'v9.99.100@996434e5492cb4c3edcb9168db6fbb1359ef965a',
  'paragonie/sodium_compat' => 'v1.17.1@ac994053faac18d386328c91c7900f930acadf1e',
  'patchwork/utf8' => 'v1.3.3@e1fa4d4a57896d074c9a8d01742b688d5db4e9d5',
  'phenx/php-font-lib' => '0.5.4@dd448ad1ce34c63d09baccd05415e361300c35b4',
  'phenx/php-svg-lib' => '0.3.4@f627771eb854aa7f45f80add0f23c6c4d67ea0f2',
  'php-http/guzzle6-adapter' => 'v2.0.2@9d1a45eb1c59f12574552e81fb295e9e53430a56',
  'php-http/httplug' => '2.3.0@f640739f80dfa1152533976e3c112477f69274eb',
  'php-http/message-factory' => 'v1.0.2@a478cb11f66a6ac48d8954216cfed9aa06a501a1',
  'php-http/promise' => '1.1.0@4c4c1f9b7289a2ec57cde7f1e9762a5789506f88',
  'php-parallel-lint/php-console-color' => 'v0.3@b6af326b2088f1ad3b264696c9fd590ec395b49e',
  'php-parallel-lint/php-console-highlighter' => 'v0.5@21bf002f077b177f056d8cb455c5ed573adfdbb8',
  'phpoffice/phpspreadsheet' => '1.23.0@21e4cf62699eebf007db28775f7d1554e612ed9e',
  'phpoption/phpoption' => '1.8.1@eab7a0df01fe2344d172bff4cd6dbd3f8b84ad15',
  'phpseclib/phpseclib' => '2.0.37@c812fbb4d6b4d7f30235ab7298a12f09ba13b37c',
  'psr/container' => '1.1.2@513e0666f7216c7459170d56df27dfcefe1689ea',
  'psr/http-client' => '1.0.1@2dfb5f6c5eff0e91e20e913f8c5452ed95b86621',
  'psr/http-factory' => '1.0.1@12ac7fcd07e5b077433f5f2bee95b3a771bf61be',
  'psr/http-message' => '1.0.1@f6561bf28d520154e4b0ec72be95418abe6d9363',
  'psr/log' => '1.1.4@d49695b909c3b7628b6289db5479a1c204601f11',
  'psr/simple-cache' => '1.0.1@408d5eafb83c57f6365a3ca330ff23aa4a5fa39b',
  'psy/psysh' => 'v0.9.12@90da7f37568aee36b116a030c5f99c915267edd4',
  'pusher/pusher-php-server' => 'v4.1.5@251f22602320c1b1aff84798fe74f3f7ee0504a9',
  'ralouphie/getallheaders' => '3.0.3@120b605dfeb996808c31b6477290a714d356e822',
  'ramsey/uuid' => '3.9.6@ffa80ab953edd85d5b6c004f96181a538aad35a3',
  'razorpay/razorpay' => 'v2.8.2@f36ad5ec74522d2930ffad3b160dddc454e42f4d',
  'rmccue/requests' => 'v1.8.0@afbe4790e4def03581c4a0963a1e8aa01f6030f1',
  'sabberworm/php-css-parser' => '8.4.0@e41d2140031d533348b2192a83f02d8dd8a71d30',
  'setasign/fpdi' => 'v2.3.6@6231e315f73e4f62d72b73f3d6d78ff0eed93c31',
  'spatie/db-dumper' => '2.21.1@05e5955fb882008a8947c5a45146d86cfafa10d1',
  'spatie/dropbox-api' => '1.20.1@f7563632fa6e4970b895805169688be273fcbf19',
  'spatie/flysystem-dropbox' => '1.2.3@8b6b072f217343b875316ca6a4203dd59f04207a',
  'spatie/laravel-activitylog' => '3.9.1@659738573f8607191afbd2b794db8669a5b20951',
  'spatie/laravel-backup' => '5.12.1@553562557ef13fda0e823cc609cd7d4f2c4f2552',
  'spatie/laravel-permission' => '2.38.0@674ad54a0ba95d8ad26990aa250b5c9d9b165e15',
  'spatie/string' => '2.2.3@79ed501c8d624fb85bf71da4254e1878fb616c51',
  'spatie/temporary-directory' => '1.3.0@f517729b3793bca58f847c5fd383ec16f03ffec6',
  'spipu/html2pdf' => 'v5.2.5@c002749cf21733d53fb9e50d082ca3d1bde06c85',
  'srmklive/paypal' => '1.10.0@188bb21f06f58aa3ad3dd6a25e91a1fc34bff68c',
  'stripe/stripe-php' => 'v6.43.1@42fcdaf99c44bb26937223f8eae1f263491d5ab8',
  'swiftmailer/swiftmailer' => 'v6.3.0@8a5d5072dca8f48460fce2f4131fcc495eec654c',
  'symfony/console' => 'v4.4.41@0e1e62083b20ccb39c2431293de060f756af905c',
  'symfony/css-selector' => 'v5.4.3@b0a190285cd95cb019237851205b8140ef6e368e',
  'symfony/debug' => 'v4.4.41@6637e62480b60817b9a6984154a533e8e64c6bd5',
  'symfony/deprecation-contracts' => 'v2.5.1@e8b495ea28c1d97b5e0c121748d6f9b53d075c66',
  'symfony/error-handler' => 'v4.4.41@529feb0e03133dbd5fd3707200147cc4903206da',
  'symfony/event-dispatcher' => 'v4.4.37@3ccfcfb96ecce1217d7b0875a0736976bc6e63dc',
  'symfony/event-dispatcher-contracts' => 'v1.1.12@1d5cd762abaa6b2a4169d3e77610193a7157129e',
  'symfony/finder' => 'v4.4.41@40790bdf293b462798882ef6da72bb49a4a6633a',
  'symfony/http-client-contracts' => 'v2.5.1@1a4f708e4e87f335d1b1be6148060739152f0bd5',
  'symfony/http-foundation' => 'v4.4.41@27441220aebeb096b4eb8267acaaa7feb5e4266c',
  'symfony/http-kernel' => 'v4.4.41@7f8ce5bffc3939c63b7da32de5a546c98eb67698',
  'symfony/mime' => 'v5.4.8@af49bc163ec3272f677bde3bc44c0d766c1fd662',
  'symfony/polyfill-ctype' => 'v1.25.0@30885182c981ab175d4d034db0f6f469898070ab',
  'symfony/polyfill-iconv' => 'v1.25.0@f1aed619e28cb077fc83fac8c4c0383578356e40',
  'symfony/polyfill-intl-idn' => 'v1.25.0@749045c69efb97c70d25d7463abba812e91f3a44',
  'symfony/polyfill-intl-normalizer' => 'v1.25.0@8590a5f561694770bdcd3f9b5c69dde6945028e8',
  'symfony/polyfill-mbstring' => 'v1.25.0@0abb51d2f102e00a4eefcf46ba7fec406d245825',
  'symfony/polyfill-php72' => 'v1.25.0@9a142215a36a3888e30d0a9eeea9766764e96976',
  'symfony/polyfill-php73' => 'v1.25.0@cc5db0e22b3cb4111010e48785a97f670b350ca5',
  'symfony/polyfill-php80' => 'v1.25.0@4407588e0d3f1f52efb65fbe92babe41f37fe50c',
  'symfony/process' => 'v4.4.41@9eedd60225506d56e42210a70c21bb80ca8456ce',
  'symfony/psr-http-message-bridge' => 'v1.3.0@9d3e80d54d9ae747ad573cad796e8e247df7b796',
  'symfony/routing' => 'v4.4.41@c25e38d403c00d5ddcfc514f016f1b534abdf052',
  'symfony/service-contracts' => 'v2.5.1@24d9dc654b83e91aa59f9d167b131bc3b5bea24c',
  'symfony/translation' => 'v4.4.41@dcb67eae126e74507e0b4f0b9ac6ef35b37c3331',
  'symfony/translation-contracts' => 'v2.5.1@1211df0afa701e45a04253110e959d4af4ef0f07',
  'symfony/var-dumper' => 'v4.4.41@58eb36075c04aaf92a7a9f38ee9a8b97e24eb481',
  'tecnickcom/tcpdf' => '6.4.4@42cd0f9786af7e5db4fcedaa66f717b0d0032320',
  'tijsverkoyen/css-to-inline-styles' => '2.2.4@da444caae6aca7a19c0c140f68c6182e337d5b1c',
  'twilio/sdk' => '5.41.1@b10341d50d647b1015dd264c530f3b8bca345b6c',
  'unicodeveloper/laravel-paystack' => '1.0.4@533d45b3e7c68e283a2ed71ddd45af1ef7728873',
  'vlucas/phpdotenv' => 'v3.6.10@5b547cdb25825f10251370f57ba5d9d924e6f68e',
  'vonage/client' => '2.3.0@e9c1492a9f1572124143e6fa963da417bb20d9ae',
  'vonage/client-core' => '2.1.0@ef7e8a0715c93c5ddc7915e8a29f29331798bb52',
  'yajra/laravel-datatables-oracle' => 'v9.19.2@c0d7b1ff493ae7391050e392262579aa700f9241',
  'zendframework/zend-diactoros' => '2.2.1@de5847b068362a88684a55b0dbb40d85986cfa52',
  'barryvdh/laravel-debugbar' => 'v3.4.2@91ee8b3acf0d72a4937f4855bd245acbda9910ac',
  'beyondcode/laravel-dump-server' => '1.3.0@fcc88fa66895f8c1ff83f6145a5eff5fa2a0739a',
  'doctrine/instantiator' => '1.4.1@10dcfce151b967d20fde1b34ae6640712c3891bc',
  'filp/whoops' => '2.14.5@a63e5e8f26ebbebf8ed3c5c691637325512eb0dc',
  'fzaninotto/faker' => 'v1.9.2@848d8125239d7dbf8ab25cb7f054f1a630e68c2e',
  'hamcrest/hamcrest-php' => 'v2.0.1@8c3d0a3f6af734494ad8f6fbbee0ba92422859f3',
  'maximebf/debugbar' => 'v1.18.0@0d44b75f3b5d6d41ae83b79c7a4bceae7fbc78b6',
  'mnapoli/front-yaml' => '1.8.0@76baa8ca538e111bfe53ac49c6a512ec5ea2bf54',
  'mnapoli/silly' => '1.8.0@c35cd1df043bedd229c6d8a7c14f0e7b9b3c1a27',
  'mockery/mockery' => '1.3.5@472fa8ca4e55483d55ee1e73c963718c4393791d',
  'mpociot/documentarian' => '0.4.0@c7dc266b6646a49f82b304a3451e41161cc4b1c3',
  'mpociot/laravel-apidoc-generator' => '4.8.2@9015d39020dc1d7e80b0cd012bc1e999fd2542ca',
  'mpociot/reflection-docblock' => '1.0.1@c8b2e2b1f5cebbb06e2b5ccbf2958f2198867587',
  'nunomaduro/collision' => 'v3.2.0@f7c45764dfe4ba5f2618d265a6f1f9c72732e01d',
  'phar-io/manifest' => '1.0.3@7761fcacf03b4d4f16e7ccb606d4879ca431fcf4',
  'phar-io/version' => '2.0.1@45a2ec53a73c70ce41d55cedef9063630abaf1b6',
  'php-di/invoker' => '2.3.3@cd6d9f267d1a3474bdddf1be1da079f01b942786',
  'phpdocumentor/reflection-common' => '2.2.0@1d01c49d4ed62f25aa84a747ad35d5a16924662b',
  'phpdocumentor/reflection-docblock' => '5.3.0@622548b623e81ca6d78b721c5e029f4ce664f170',
  'phpdocumentor/type-resolver' => '1.6.1@77a32518733312af16a44300404e945338981de3',
  'phpspec/prophecy' => 'v1.15.0@bbcd7380b0ebf3961ee21409db7b38bc31d69a13',
  'phpunit/php-code-coverage' => '6.1.4@807e6013b00af69b6c5d9ceb4282d0393dbb9d8d',
  'phpunit/php-file-iterator' => '2.0.5@42c5ba5220e6904cbfe8b1a1bda7c0cfdc8c12f5',
  'phpunit/php-text-template' => '1.2.1@31f8b717e51d9a2afca6c9f046f5d69fc27c8686',
  'phpunit/php-timer' => '2.1.3@2454ae1765516d20c4ffe103d85a58a9a3bd5662',
  'phpunit/php-token-stream' => '3.1.3@9c1da83261628cb24b6a6df371b6e312b3954768',
  'phpunit/phpunit' => '7.5.20@9467db479d1b0487c99733bb1e7944d32deded2c',
  'sebastian/code-unit-reverse-lookup' => '1.0.2@1de8cd5c010cb153fcd68b8d0f64606f523f7619',
  'sebastian/comparator' => '3.0.3@1071dfcef776a57013124ff35e1fc41ccd294758',
  'sebastian/diff' => '3.0.3@14f72dd46eaf2f2293cbe79c93cc0bc43161a211',
  'sebastian/environment' => '4.2.4@d47bbbad83711771f167c72d4e3f25f7fcc1f8b0',
  'sebastian/exporter' => '3.1.4@0c32ea2e40dbf59de29f3b49bf375176ce7dd8db',
  'sebastian/global-state' => '2.0.0@e8ba02eed7bbbb9e59e43dedd3dddeff4a56b0c4',
  'sebastian/object-enumerator' => '3.0.4@e67f6d32ebd0c749cf9d1dbd9f226c727043cdf2',
  'sebastian/object-reflector' => '1.1.2@9b8772b9cbd456ab45d4a598d2dd1a1bced6363d',
  'sebastian/recursion-context' => '3.0.1@367dcba38d6e1977be014dc4b22f47a484dac7fb',
  'sebastian/resource-operations' => '2.0.2@31d35ca87926450c44eae7e2611d45a7a65ea8b3',
  'sebastian/version' => '2.0.1@99732be0ddb3361e16ad77b68ba41efc8e979019',
  'symfony/var-exporter' => 'v5.4.8@7e132a3fcd4b57add721b4207236877b6017ec93',
  'symfony/yaml' => 'v5.3.14@c441e9d2e340642ac8b951b753dea962d55b669d',
  'theseer/tokenizer' => '1.2.1@34a41e998c2183e22995f158c581e7b5e755ab9e',
  'webmozart/assert' => '1.10.0@6964c76c7804814a842473e0c8fd15bab0f18e25',
  'windwalker/renderer' => '3.5.23@b157f2832dac02209db032cb61e21b8264ee4499',
  'windwalker/structure' => '3.5.23@59466adb846685d60463f9c1403df2832d2fcf90',
  'laravel/laravel' => 'dev-main@e39217323440ef5f00ed492e13ab1b1edb3d2c3f',
);

    private function __construct()
    {
    }

    /**
     * @throws OutOfBoundsException If a version cannot be located.
     *
     * @psalm-param key-of<self::VERSIONS> $packageName
     * @psalm-pure
     */
    public static function getVersion(string $packageName) : string
    {
        if (isset(self::VERSIONS[$packageName])) {
            return self::VERSIONS[$packageName];
        }

        throw new OutOfBoundsException(
            'Required package "' . $packageName . '" is not installed: check your ./vendor/composer/installed.json and/or ./composer.lock files'
        );
    }
}
