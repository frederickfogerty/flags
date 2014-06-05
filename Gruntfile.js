 module.exports = function(grunt) {

    // Project configuration.
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        uglify: {
            options: {
                banner: '/*! <%= pkg.name %> <%= grunt.template.today("dd-mm-yy") %> */\n'
            },
            js: {
                files: {
                    'dev/js/app.min.js' : ['src/js/app.js']
                }
            },
            build: {
                src: 'src/<%= pkg.name %>.js',
                dest: 'build/<%= pkg.name %>.min.js'
            }
        },
        compass: {
            dev: {
                options: {
                    sassDir: 'src/sass',
                    cssDir: 'dev/css'
                }
                    
            }
        },
        copy: {
            main: {
                files: [
                    {cwd: 'src/', expand: true, src: ['*.html', '*.php', 'backend/*', 'css/*', 'js/**', 'tpl/*'], dest: 'dev/'},
                    {cwd: 'src/res/public/', expand: true, src: ['**'], dest: 'dev/res/'}
                    // {cwd: 'bower_components/foundation/', expand: true, src: ['css/*', 'js/*']}
                ],
                nonull: true
            }
        },

        watch: {
            js: {
                files: ['src/js/*.js'],
                tasks: ['uglify:js'],
                options: {
                    livereload: true,
                    atBegin: true 
                }
            },
            css: {
                files: ['src/sass/*'],
                tasks: ['compass:dev'],
                options: {
                    livereload: true,
                    atBegin: true 
                }
            },
            statics: {
                files: ['src/*.html', 'src/tpl/**', 'src/*', 'src/res/public/**', 'src/backend/**', 'src/css/*', 'src/js/*', 'bower_components/*'],
                tasks: ['copy:main'],
                options: {
                    livereload: true,
                    atBegin: true 
                }
            }
        }
    });

    // Load the plugin that provides the "uglify" task.
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-compass');

    // Default task(s).
    // grunt.registerTask('watch', ['watch']);

};