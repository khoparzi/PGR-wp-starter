module.exports = function(grunt) {
 
  // configure the tasks
  grunt.initConfig({
 
    copy: {
      build: {
        cwd: '../../../../daisy/www/public/css',
        src: [ 'style.css' ],
        dest: 'css',
        expand: true
      },
    },
    clean: {
      build: {
        src: [ 'css' ]
      },
    },
    watch: {
      css: {
        files: ['../../../../daisy/www/public/css/style.css'],
        tasks: ['build'],
        options: {
          spawn: false,
          livereload: true
        }
      },
      php: {
        cwd: '.',
        files: ['*.php'],
        options: {
          livereload: true
        }
      }
    }
 
  });
 
  // load the tasks
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-contrib-watch');
 
  // define the tasks
  grunt.registerTask(
    'build', 
    'Compiles all of the assets and copies the files to the build directory.', 
    [ 'clean', 'copy' ]
  );

  grunt.registerTask('default', ['watch']);
};