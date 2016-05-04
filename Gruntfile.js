module.exports = function(grunt) {
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    /**
    * Set project object
    */
    project: {
      name: 'Passenger',
      website: 'https://www.passengerapp.com',
      assets: 'web',
      src: '<%= project.app %>/Resources/public',
      css: [
        '<%= project.src %>/scss/css/*.less'
      ],
      js: [
        '<%= project.src %>/js/*.js'
      ]
    },
    /**
    * Project banner
    */
    tag: {
      banner: '/*!\n' +
              ' * <%= pkg.name %>\n' +
              ' * <%= pkg.title %>\n' +
              ' * <%= pkg.url %>\n' +
              ' * @author <%= pkg.author %>\n' +
              ' * @version <%= pkg.version %>\n' +
              ' * Copyright <%= pkg.copyright %>. <%= pkg.license %> licensed.\n' +
              ' */\n'
    },
    concat: {
      options: {
        separator: ';'
      },
      dist: {
        src: ['app/Resources/public/js/*.js'],
        dest: 'dist/<%= pkg.name %>.js'
      }
    },
    uglify: {
      options: {
        banner: '/*! <%= pkg.name %> <%= grunt.template.today("dd-mm-yyyy") %> */\n'
      },
      dist: {
        files: {
          'app/Resources/public/js/<%= pkg.name %>.min.js': ['<%= concat.dist.dest %>']
        }
      }
    },
    jshint: {
      files: ['Gruntfile.js', 'app/Resources/public/js/*.js', 'app/Resources/public/test/js/*.js']
      options: {
        // options here to override JSHint defaults
        globals: {
          jQuery: true,
          console: true,
          module: true,
          document: true
        }
      }
    },
    /**
    * Sass
    */
    sass: {
      dev: {
        options: {
          style: 'expanded',
          banner: '/*! <%= pkg.name %> <%= grunt.template.today("dd-mm-yyyy") %> */\n',
          compass: true
        },
        files: {
          '<%= project.assets %>/css/*.css': '<%= project.css %>'
        }
      },
      dist: {
        options: {
          style: 'compressed',
          compass: true
        },
        files: {
          '<%= project.assets %>/css/*.css': '<%= project.css %>'
        }
      }
    },
    watch: {
      files: ['<%= jshint.files %>', '<%= css.files %>', '<%= project.src %>/scss/{,*/}*.{scss,sass}'],
      tasks: ['jshint', 'sass:dev']
    }
  }
});

grunt.loadNpmTasks('grunt-contrib-uglify');
grunt.loadNpmTasks('grunt-contrib-jshint');
grunt.loadNpmTasks('grunt-contrib-qunit');
grunt.loadNpmTasks('grunt-contrib-watch');
grunt.loadNpmTasks('grunt-contrib-concat');
grunt.loadNpmTasks('grunt-contrib-sass');

grunt.registerTask('test', ['jshint']);
grunt.registerTask('default', ['jshint', 'concat', 'uglify', 'sass:dev']);

}
