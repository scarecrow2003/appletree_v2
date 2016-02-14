module.exports = function(grunt) {

	grunt.initConfig({

		pkg: grunt.file.readJSON('package.json'),

		// chech our JS
		jshint: {
			options: {
				"bitwise": true,
				"browser": true,
				"curly": true,
				"eqeqeq": true,
				"eqnull": true,
				"esnext": true,
				"immed": true,
				"jquery": true,
				"latedef": true,
				"newcap": true,
				"noarg": true,
				"node": true,
				"strict": false,
				"trailing": true,
				"undef": true,
				"globals": {
					"jQuery": true,
					"alert": true
				}
			},
			all: [
				'gruntfile.js',
				'../js/script.js'
			]
		},

		// concat and minify our JS
		uglify: {
			dist: {
				files: {
					'../js/scripts.min.js': [
						'../js/scripts.js'
					]
				}
			}
		},

		// compile your sass
		sass: {
            options: {
                includePaths: [
                    'bower_components'
                ]
            },
            dist: {
                files: [{
                    expand: true,
                    cwd: '../scss',
                    src: ['*.scss'],
                    dest: '.tmp/styles',
                    ext: '.css'
                }]
            }
			/*dev: {
				options: {
					style: 'expanded'
				},
				src: ['../scss/style.scss'],
				dest: '../style.css'
			},
			prod: {
				options: {
					style: 'compressed'
				},
				src: ['../scss/style.scss'],
				dest: '../style.css'
			},
			editorstyles: {
				options: {
					style: 'expanded'
				},
				src: ['../scss/wp-editor-style.scss'],
				dest: '../css/wp-editor-style.css'
			}*/
		},

		// watch for changes
		watch: {
			scss: {
				files: ['../scss/**/*.scss'],
				tasks: [
					'sass:dist',
                    'autoprefixer',
                    'cssmin',
					'notify:scss'
				]
			},
			js: {
				files: [
					'<%= jshint.all %>'
				],
				tasks: [
					'jshint',
					'uglify',
					'notify:js'
				]
			}
		},

		// check your php
		phpcs: {
			application: {
				dir: '../*.php'
			},
			options: {
				bin: '/usr/bin/phpcs'
			}
		},

		// notify cross-OS
		notify: {
			scss: {
				options: {
					title: 'Grunt, grunt!',
					message: 'SCSS is all gravy'
				}
			},
			js: {
				options: {
					title: 'Grunt, grunt!',
					message: 'JS is all good'
				}
			},
			dist: {
				options: {
					title: 'Grunt, grunt!',
					message: 'Theme ready for production'
				}
			}
		},

		/*clean: {
			dist: {
				src: ['../../appletree/', '.tmp'],
				options: {
					force: true,
                    dot: true
				}
			}
		},*/

		//copyto: {
		//	dist: {
		//		files: [
        //
		//			//{cwd: '../', src: ['**/*'], dest: '../../appletree/'}
        //
		//		],
		//		options: {
		//			ignore: [
		//				'../dist{,/**/*}',
		//				'../doc{,/**/*}',
		//				'../grunt{,/**/*}',
		//				'../scss{,/**/*}'
		//			]
		//		}
		//	}
		//},

        copy: {
            styles: {
                expand: true,
                dot: true,
                cwd: '../scss',
                dest: '.tmp/styles/',
                src: '{,*/}*.css'
            },
            bowerFiles: {
                files: [
                    {
                        expand: true,
                        dot: true,
                        cwd: '.',
                        src: [
                            'bower_components/bootstrap-sass/assets/fonts/bootstrap/*.*',
                            'bower_components/bootstrap-sass/assets/javascripts/*.*',
                            'bower_components/owl.carousel/dist/*.js',
                            'bower_components/owl.carousel/dist/assets/*.*',
                            'bower_components/jquery/dist/*.*',
                            'bower_components/picturefill/dist/*.*',
                            'bower_components/font-awesome/fonts/*.*',
                            'bower_components/font-awesome/css/*.*'
                        ],
                        dest: '../'
                    }
                ]
            }
        },

        // By default, your `index.html`'s <!-- Usemin block --> will take care of
        // minification. These next options are pre-configured if you do not wish
        // to use the Usemin blocks.
        cssmin: {
            local: {
                files: {
                    '../style.css' : ['.tmp/styles/*.css']
                }
            }/*,
            dist: {
                files: {
                    '../../appletree/style.css' : ['.tmp/styles*//*.css']
                }
            }*/
        },

        // Add vendor prefixed styles
        autoprefixer: {
            options: {
                browsers: ['last 1 version']
            },
            dist: {
                files: [{
                    expand: true,
                    cwd: '.tmp/styles/',
                    src: '{,*/}*.css',
                    dest: '.tmp/styles/'
                }]
            }
        },

        pot: {
            options: {
                text_domain: 'appletreesg.com',
                dest: '../languages/',
                keywords: [ // WordPress localisation functions
                    '__:1',
                    '_e:1',
                    '_x:1,2c',
                    'esc_html__:1',
                    'esc_html_e:1',
                    'esc_html_x:1,2c',
                    'esc_attr__:1',
                    'esc_attr_e:1',
                    'esc_attr_x:1,2c',
                    '_ex:1,2c',
                    '_n:1,2',
                    '_nx:1,2,4c',
                    '_n_noop:1,2',
                    '_nx_noop:1,2,3c'
                ]
            },
            files: {
                src: '../*.php',
                expand: true
            }
        },

        po2mo: {
            files: {
                src: '../languages/*.po',
                expand: true
            }
        }
	});

	// Load NPM's via matchdep
	require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

	// Development task
	grunt.registerTask('default', [
		'jshint',
		'uglify',
		/*'sass:dev',
		'sass:editorstyles'*/
        'sass',
        'autoprefixer',
        'cssmin'
	]);

    grunt.registerTask('build', function() {
        grunt.task.run([
            'jshint',
            'uglify',
            /*'sass:prod',
             'sass:editorstyles',*/
            'sass',
            'autoprefixer',
            'cssmin',
            /*'clean:dist',*/
            /*'copyto:dist',*/
            'copy:bowerFiles',
            'notify:dist'
        ]);
    });

	// Production task
	grunt.registerTask('dist', function() {
		grunt.task.run([
			'jshint',
			'uglify',
			/*'sass:prod',
			'sass:editorstyles',*/
            'sass',
            'autoprefixer',
            'cssmin',
			/*'clean:dist',*/
            'po2mo',
			/*'copyto:dist',*/
            'copy:bowerFiles',
			'notify:dist'
		]);
	});
};