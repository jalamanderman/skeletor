module.exports = function(grunt) {

    // Project configuration.
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        concat: {
            js: {
                src: [
						// load our vendor files first
						'site/js/vendor/*.js',
						
						// then load everything else
						'site/js/*.js'
					],
                dest: 'site/production/site.js'
            }
        },
        uglify: {
            options: {
                banner: '/**\n * <%= pkg.name %>\n * Built <%= grunt.template.today("yyyy-mm-dd") %>\n **/\n\n',
				ASCIIOnly: 'true',
				drop_console: true
            },
            build: {
                src: 'site/production/site.js',
                dest: 'site/production/site.min.js'
            }
        },
        sass: {
			dist: {
				options: {
					style: 'compressed'
				},
				files: {
					'site/production/site.css': 'site/scss/main.scss'
				}
			}
        },
		watch: {
			scripts: {
				files: ['site/js/*.js'],
				tasks: ['concat','uglify']
			},
			css: {
				files: 'site/scss/**/*.scss',
				tasks: ['sass']
			}
		}
    });

    // Load the plugin that provides the "uglify" task.
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-watch');

    // Default task(s).
    grunt.registerTask('default', ['concat', 'uglify', 'sass', 'watch']);

};