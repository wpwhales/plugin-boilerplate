// Generated using webpack-cli https://github.com/webpack/webpack-cli

const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const {WebpackManifestPlugin} = require('webpack-manifest-plugin');
const getLogger = require('webpack-log');
const log = getLogger({name: 'webpack-batman'});
const isProduction = process.env.NODE_ENV == 'production';
const ImageMinimizerPlugin = require("image-minimizer-webpack-plugin");
const CopyPlugin = require('copy-webpack-plugin');
const entryPoints = require("./entrypoints");




const stylesHandler = isProduction ? MiniCssExtractPlugin.loader : 'style-loader';



const webPackEntryPoints = {};

// home: { import: './contact.js', filename: 'pages/[name].js' },
for (let entry in entryPoints) {
    webPackEntryPoints[entry] = {
        import: entryPoints[entry],
        filename: 'js/[name].[contenthash].js'
    }

}
const config = {
    context: path.resolve(__dirname, 'resources'),
    entry: webPackEntryPoints,
    output: {
        publicPath: "/",
        path: path.resolve(__dirname, 'build'),
        asyncChunks: true,
        chunkFilename: 'js/[id].js',
        clean: true
    },
    optimization: {
        splitChunks:{
            chunks: 'all',
            cacheGroups: {
                vendors: {
                    test: /[\\/]node_modules[\\/]/,
                    filename: "js/[id].[contenthash].js",
                    chunks: 'all'
                }

            },

        },
        chunkIds: 'deterministic',
        emitOnErrors: true,
        minimizer: [
            "...",
            new ImageMinimizerPlugin({
                minimizer: {
                    filename: "[path][name][ext]",
                    implementation: ImageMinimizerPlugin.imageminMinify,
                    options: {
                        // Lossless optimization with custom option
                        // Feel free to experiment with options for better result for you
                        plugins: [
                            ["gifsicle", {interlaced: true}],
                            ["jpegtran", {progressive: true}],
                            ["optipng", {optimizationLevel: 5}],
                            // Svgo configuration here https://github.com/svg/svgo#configuration
                            [
                                "svgo",
                                {
                                    plugins: [
                                        {
                                            name: "preset-default",
                                            params: {
                                                overrides: {
                                                    removeViewBox: false,
                                                    addAttributesToSVGElement: {
                                                        params: {
                                                            attributes: [
                                                                {xmlns: "http://www.w3.org/2000/svg"},
                                                            ],
                                                        },
                                                    },
                                                },
                                            },
                                        },
                                    ],
                                },
                            ],
                        ],
                    },
                },
            }),
        ]

    },
    devServer: {
        open: true,
        hot: false,
        liveReload:true,
        host: 'localhost',
        compress: true,
        port: 9000,
        server: "https",
        proxy: {
            '/': {
                target: 'https://athletes-ocean.lndo.site',
                secure: false,
                changeOrigin: true,
            },

        },
        headers: {
            "host": "athletes-ocean.lndo.site"
        },
        client: {
            reconnect: true,
            logging: 'info',
            overlay: {
                errors: true,
                warnings: false,
                runtimeErrors: true,
            },
        },

    },
    plugins: [
        new CopyPlugin({
            patterns: [
                {from: "images", to: "images"},
                {from: "fonts", to: "fonts"},
                {from: "scripts/misc", to({ context, absoluteFilename }) {

                        return "misc/[path][name]-[contenthash][ext]";
                    }},
            ],
        }),
        new WebpackManifestPlugin({
            fileName: 'entrypoints.json',
            generate: function (a, b, inputJSON) {
                const output = {};

                for (const key in inputJSON) {
                    const values = inputJSON[key];
                    output[key] = {
                        css: values.filter(value => value.endsWith('.css')),
                        js: values.filter(value => value.endsWith('.js'))
                    };
                }
                return output
            }
        }),
        new WebpackManifestPlugin({
            fileName: 'manifest.json',
            // Output manifest file
        }),
        // Add your plugins here
        // Learn more about plugins from https://webpack.js.org/configuration/plugins/
    ],
    module: {
        rules: [
            {
                test: /\.svg$/,
                use: ['raw-loader']
            }, {
                test: /\.ts$/,
                use: 'ts-loader'
            },
            {
                test: /\.(js|jsx)$/i,
                loader: 'babel-loader',
            },
            {
                test: /\.css$/i,
                use: [stylesHandler, {
                    loader: 'css-loader',
                    options: {
                        url: false, // Disable URL handling
                    },
                }, 'postcss-loader'],
            },
            {
                test: /\.scss$/i,
                use: [stylesHandler, {
                    loader: 'css-loader',
                    options: {
                        url: false, // Disable URL handling
                    },
                }, 'sass-loader'],
            },
            {
                test: /\.(eot|svg|ttf|woff|woff2|png|jpg|gif)$/i,
                type: 'asset',
            },

            // Add your rules for custom modules here
            // Learn more about loaders from https://webpack.js.org/loaders/
        ],
    },
};

module.exports = () => {
    if (isProduction) {
        config.mode = 'production';

        config.plugins.push(new MiniCssExtractPlugin({filename: 'css/[name].[contenthash].css',}));


    } else {
        config.mode = 'development';
    }
    config.stats={
        all: undefined,
        assets: true,
        assetsSort: 'field',
        cached: true,
        children: false,
        chunks: false,
        chunkModules: false,
        chunkOrigins: false,
        chunksSort: 'field',
        colors: true,
        errors: true,
        errorDetails: true,
        hash: true,
        modules: false,
        modulesSort: 'field',
        publicPath: true,
        reasons: true,
        source: true,
        timings: true,
        version: true,
        warnings: true
    }
    return config;
};
