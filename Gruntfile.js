module.exports = function(grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        bumpup: {
            file: 'package.json'
        },
        watch: {
            sass: {
                files: ['scss/*.{scss,sass}','scss/partials/*.{scss,sass}'],
                tasks: ['sass:dist', 'autoprefixer:build']
            },
            concat: {
                files: ['js/partials/**/*.js'],
                tasks: ['concat:dist'],
            },
            livereload: {
                files: ['*.html', '*.php', '**/*.php', 'js/**/*.{js,json}', '*.css','img/**/*.{png,jpg,jpeg,gif,webp,svg}'],
                options: {
                    livereload: true
                }
            },
        },
        sass: {
            dist: {
                options: {
                    sourceMap: true,
                    sourceMapEmbed: true,
                    sourceComments: true,
                    outputStyle: 'expanded',
                },
                files: {
                    'style.css': 'scss/style.scss',
                    'admin.css': 'scss/admin.scss',
                }
            },
            build: {
                options: {
                    sourceMap: false,
                    sourceMapEmbed: false,
                    sourceComments: false,
                    outputStyle: 'compressed'                },
                files: {
                    'style.css': 'scss/style.scss',
                    'admin.css': 'scss/admin.scss',
                }
            },
        },
        concat: {
            dist: {
                files: {
                   'js/script.js': ['js/partials/*.js'],
                }
            }
                },
        uglify: {
            options: {
                banner: '/*! "UNSHACKLED!" JavaScript copyright <%= grunt.template.today("yyyy") %> */\n',
            },
            build: {
                files: {
                   'js/script.js': ['js/partials/*.js'],
                }
            }
        },
        autoprefixer: {
            options: {
                browsers: ['last 8 versions', 'ie 8', 'ie 9'],
                map: false,
                annotation: false
            },
            build:{
                src: './style.css',
                dest: './style.css'
            }
        },
        usebanner: {
            build: {
                options: {
                    position: 'top',
                    banner: '/*!\n' +
                        ' * Theme Name: unshackled\n' +
                        ' * Theme URI: laternastudio.com\n' +
                        ' * Description: The main website theme for "UNSHACKLED!"\n' +
                        ' * Author: Laterna Studio <pete@laternastudio.com>\n' +
                        ' * Version: <%= pkg.version %>\n' +
                        ' */\n',
                    linebreak: true
                },
                files: {
                    src: [ 'style.css' ]
                }
            }
        },
    });

    grunt.registerTask('default', ['sass:dist', 'usebanner:build', 'concat:dist', 'watch' ]);

    // Create a task for refreshing the package.json info, so that we can re-acquire it after bumping
    grunt.task.registerTask('refreshPKG', 'Refresh the loaded info from package.json', function() {
        grunt.config.set('pkg', grunt.file.readJSON('./package.json'));
    });

    // Set up build task and flags
    var build_type = grunt.option('type') || 'patch';
    grunt.registerTask('build', ['bumpup:' + build_type, 'refreshPKG', 'sass:build', 'autoprefixer:build', 'usebanner:build', 'uglify:build' ]);

    grunt.loadNpmTasks('grunt-sass');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-autoprefixer');
    grunt.loadNpmTasks('grunt-banner');
    grunt.loadNpmTasks('grunt-bumpup');
};
