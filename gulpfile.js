const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir((mix) => {
    mix.sass('app.scss')
    .webpack('app.js')
    .scripts(['helper.js'], 'public/js/helper.js')
    .version(['css/app.css', 'js/app.js', 'js/helper.js'])

    // copy npm and bower into public directory
    .copy('node_modules/bootstrap-sass/assets/fonts/bootstrap/', 'public/build/fonts/bootstrap/')
    .copy('bower_components/autogrow-textarea/jquery.autogrowtextarea.min.js','public/assets/autogrow-textarea/jquery.autogrowtextarea.min.js')
    .copy('bower_components/bootbox.js/bootbox.js','public/assets/bootbox.js/bootbox.js')
    .copy('bower_components/bootstrap/dist/','public/assets/bootstrap/')
    .copy('bower_components/bootstrap-datepicker/dist/','public/assets/bootstrap-datepicker/')
    .copy('bower_components/bootstrap-datepicker/dist/','public/assets/bootstrap-datepicker/')
    .copy('bower_components/bootstrap-daterangepicker/daterangepicker.css','public/assets/bootstrap-daterangepicker/daterangepicker.css')
    .copy('bower_components/bootstrap-timepicker/js/bootstrap-timepicker.js','public/assets/bootstrap-timepicker/bootstrap-timepicker.js')
    .copy('bower_components/datatables/media/','public/assets/datatables/')
    .copy('bower_components/datatables/media/','public/assets/datatables/')
    .copy('bower_components/dropzone/dist/min/','public/assets/dropzone/')
    .copy('bower_components/font-awesome/css/','public/assets/font-awesome/css/')
    .copy('bower_components/font-awesome/fonts/','public/assets/font-awesome/fonts/')
    .copy('bower_components/jquery/dist','public/assets/jquery/')
    .copy('bower_components/PACE/','public/assets/pace/')
    .copy('bower_components/select2/dist/','public/assets/select2/')
    .copy('bower_components/select2-bootstrap-theme/dist/','public/assets/select2-bootstrap-theme/')
    .copy('bower_components/eonasdan-bootstrap-datetimepicker/build/','public/assets/datetimepicker/')
    .copy('bower_components/moment/min/','public/assets/moment/')
        ;
});