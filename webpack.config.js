var Encore = require('@symfony/webpack-encore');
var path = require('path');

if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .addEntry('app', './assets/js/main.js')
    .splitEntryChunks()
    .enableSingleRuntimeChunk()
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = 3;
    })
    .addAliases({
        '@': path.resolve(__dirname, 'assets', 'js'),
        styles: path.resolve(__dirname, 'assets', 'scss'),
    })
    .enableSassLoader()
    .enableVueLoader()
    .configureCssLoader((config) => {
        if (!Encore.isProduction() && config.modules) {
            config.modules.localIdentName = '[name]_[local]_[hash:base64:5]';
        }
    })
;

module.exports = Encore.getWebpackConfig();
