module.exports = function (grunt) {

    grunt.loadNpmTasks('grunt-vegas-assets-prepare');
    grunt.loadNpmTasks('grunt-bower-task');

    // Project configuration.
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        "vegas-assets-prepare": {
            default: {
                files: {
                    "public/assets/bower_base.json": "vendor/common/bower.json",
                    "bower.json": ["public/assets/bower_base.json", "vendor/vegas-cmf/*/vegas.json"]
                }
            }
        },
        bower: {
            install: {
                options: {
                    targetDir: 'public/assets'
                }
            },
            update: {
                options: {
                    targetDir: 'public/assets'
                }
            }
        }

    });

    // Update dependencies tasks
    grunt.registerTask('update', ['vegas-assets-prepare', 'bower:update']);

    // Default tasks.
    grunt.registerTask('default', ['vegas-assets-prepare', 'bower:install']);

};