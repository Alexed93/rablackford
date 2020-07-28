module.exports = {
    plugins: [
        require('autoprefixer')(),
        require('postcss-preset-env')(),
        require('cssnano')({
            preset: 'default',
            zindex: false
        }),
    ],
};