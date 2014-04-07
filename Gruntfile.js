'use strict';
module.exports = function(grunt) {

  grunt.initConfig({
    jshint: {
      options: {
        jshintrc: '.jshintrc'
      },
      all: [
        'Gruntfile.js',
        'assets/js/*.js',
        'assets/js/plugins/*.js',
        'assets/js/admin/*.js',
        '!assets/js/scripts.min.js',
        '!assets/js/admin/admin.min.js',
        '!assets/js/admin/quick-edit.min.js'
      ]
    },
    recess: {
      dist: {
        options: {
          compile: true,
          compress: true
        },
        files: {
          'assets/css/main.min.css': [
            'assets/less/main.less'
          ],
          'assets/css/admin.min.css': [
            'assets/less/admin.less'
          ]
        }
      }
    },
    uglify: {
      dist: {
        files: {
          'assets/js/scripts.min.js': [
            'assets/js/plugins/*.js',
            'assets/js/_*.js',
          ],
          'assets/js/admin/admin.min.js': [
            'assets/js/admin/admin.js'
          ],
          'assets/js/admin/quick-edit.min.js': [
            'assets/js/admin/quick-edit.js'
          ]
        }
      }
    },
    version: {
      options: {
        file: 'woocommerce-wholesale-pricing.php',
        css: 'assets/css/main.min.css',
        cssHandle: 'fff_css',
        js: 'assets/js/scripts.min.js',
        jsHandle: 'fff_scripts'
      }
    },
    watch: {
      less: {
        files: [
          'assets/less/*.less'
        ],
        tasks: ['recess', 'version']
      },
      js: {
        files: [
          '<%= jshint.all %>'
        ],
        tasks: ['jshint', 'uglify', 'version']
      },
      livereload: {
        // Browser live reloading
        // https://github.com/gruntjs/grunt-contrib-watch#live-reloading
        options: {
          livereload: 35768
        },
        files: [
          'assets/css/main.min.css',
          'assets/js/scripts.min.js',
          'assets/js/admin/admin.min.js',
          'assets/js/admin/quick-edit.min.js',
          'admin/pricing/*.php',
          'admin/*.php',
          '*.php'
        ]
      }
    },
    clean: {
      dist: [
        'assets/css/main.min.css',
        'assets/css/admin.min.css',
        'assets/js/scripts.min.js',
        'assets/js/admin/admin.min.js',
        'assets/js/admin/quick-edit.min.js'
      ]
    }
  });

  // Load tasks
  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-recess');
  grunt.loadNpmTasks('grunt-wp-version');

  // Register tasks
  grunt.registerTask('default', [
    'clean',
    'recess',
    'uglify',
    'version'
  ]);
  grunt.registerTask('dev', [
    'watch'
  ]);

};
