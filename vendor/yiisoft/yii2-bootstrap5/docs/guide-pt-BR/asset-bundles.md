Asset Bundles
=============

Bootstrap é uma solução complexa para front-end, o qual inclue CSS, JavaScript, fontes e assim por diante.
A fim de permitir que você tenha controle mais flexível sobre componentes Bootstrap , esta extensão fornece vários asset bundles. Eles são:

- [[yii\bootstrap5\BootstrapAsset|BootstrapAsset]] - Contém apenas arquivos CSS.
- [[yii\bootstrap5\BootstrapPluginAsset|BootstrapPluginAsset]] - Depende de [[yii\bootstrap5\BootstrapAsset]], contem os arquivos JavaScript.

Necessidades de aplicações específicas podem exigir utilização de pacotes diferentes ( ou a combinação bundle).
Se você precisa apenas de estilos CSS, [[yii\bootstrap5\BootstrapAsset]] será o suficiente para você. No entanto , se
você quiser usar Bootstrap JavaScript, você precisa se registrar [[yii\bootstrap5\BootstrapPluginAsset]].

> Tip: a maioria dos widgets [[yii\bootstrap5\BootstrapPluginAsset]] registram automaticamente.
