const purgecss = require('@fullhuman/postcss-purgecss');
const cssnano = require('cssnano');

module.exports = {
  plugins: [
    require('tailwindcss'),
    purgecss({
      content: [
        './public/**/*.html',
        './public/**/*.php',
        './public/*.php',
        './public/*.php',
        './public/**/*.js',
      ],
      defaultExtractor: (content) => content.match(/[\w-/:]+(?<!:)/g) || [],
    }),
    cssnano({
      preset: 'default',
    }),
    require('autoprefixer'),
  ],
};
