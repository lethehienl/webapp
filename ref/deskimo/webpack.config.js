var Encore = require('@symfony/webpack-encore');

Encore
  .setOutputPath('web/build')
  .setPublicPath('/build')

  .addEntry('app', './src/AppBundle/Resources/public/js/app.js')
  .addEntry('loginPage', './src/UserBundle/Resources/public/js/loginPage.js')
  .addStyleEntry('page_error', './src/AppBundle/Resources/public/sass/pageError.scss')
  .addEntry('landing_page', './src/AppBundle/Resources/public/js/landing_page.js')
  .addEntry('smart_banner_script', './src/AppBundle/Resources/public/js/smartbanner.js')
  .addStyleEntry('smart_banner_style', './src/AppBundle/Resources/public/sass/smartbanner.scss')

  //Admin
  .addStyleEntry('admin', './src/AppBundle/Resources/public/sass/admin.scss')
  .addEntry('admin_common_util', './src/AppBundle/Resources/public/js/global/admin_common_util.js')
  .addEntry('admin_user_management', './src/UserBundle/Resources/public/js/user/user_list_main.js')
  .addEntry('admin_property_management', './src/PropertyBundle/Resources/public/property/js/property_list_main.js')
  .addEntry('admin_property_company_management', './src/CompanyBundle/Resources/public/company/js/property_company_list_main.js')
  .addEntry('admin_property_benefit_management', './src/PropertyBundle/Resources/public/benefit/js/benefit_list_main.js')
  .addEntry('admin_property_category_management', './src/PropertyBundle/Resources/public/category/js/category_list_main.js')
  .addEntry('admin_property_location_management', './src/PropertyBundle/Resources/public/location/js/location_list_main.js')
  .addEntry('admin_property_detail', './src/PropertyBundle/Resources/public/property/js/property_detail.js')
  .addEntry('admin_property_schedule_management', './src/PropertyBundle/Resources/public/schedule/js/schedule_update_main.js')
  .addEntry('admin_property_usage', './src/PropertyBundle/Resources/public/property/js/property_usage.js')
  .addEntry('admin_dashboard', './src/AppBundle/Resources/public/js/admin_dashboard.js')
  .addEntry('google_map_api', './src/PropertyBundle/Resources/public/property/js/google_map_api.js')
  .addEntry('admin_property_amenity_update', './src/PropertyBundle/Resources/public/benefit/js/property_amenity_update_main.js')
  .addEntry('admin_invoice_management', './src/InvoiceBundle/Resources/public/invoice/js/invoice_list_main.js')

  .enableSingleRuntimeChunk()
  .cleanupOutputBeforeBuild()
  .enableSourceMaps(!Encore.isProduction())
  .enableVersioning(Encore.isProduction())
  .enableSassLoader()
  .copyFiles({
    from: './src/AppBundle/Resources/public/images',
    to: 'images/[path][name].[ext]',
  })
  .copyFiles([
    {
      from: './node_modules/ckeditor/',
      to: 'ckeditor/[path][name].[ext]',
      pattern: /\.(js|css)$/,
      includeSubdirectories: false
    },
    {from: './node_modules/ckeditor/adapters', to: 'ckeditor/adapters/[path][name].[ext]'},
    {from: './node_modules/ckeditor/lang', to: 'ckeditor/lang/[path][name].[ext]'},
    {from: './node_modules/ckeditor/plugins', to: 'ckeditor/plugins/[path][name].[ext]'},
    {from: './node_modules/ckeditor/skins', to: 'ckeditor/skins/[path][name].[ext]'},
    {from: './src/AppBundle/Resources/public/templates', to: 'templates/[path][name].[ext]'}
  ])
;

module.exports = Encore.getWebpackConfig();
