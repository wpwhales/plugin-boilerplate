// https://tailwindcss.com/docs/configuration
let config = {
    content: ['./resources/views/*.blade.php','./resources/views/**/*.blade.php'],
    prefix: 'tw-',
    important:true,
    theme: {

    },
    corePlugins: {
        preflight: false,
    },
    plugins: [],
}


export default config;
