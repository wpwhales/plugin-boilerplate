<?php

/**
 * Script to initialize WordPress plugin with dynamic values.
 */

// Function to get input from the user
// Function to get input from the user with an optional default value
function getInput($prompt, $default = null) {
    echo $prompt;
    if ($default) {
        echo " [Press Enter for default: $default]: ";
    } else {
        echo ": ";
    }
    $input = trim(fgets(STDIN));

    return $input !== '' ? $input : $default;
}


function isLandoEnvironment() {
    return getenv('LANDO') !== false;
}

// Check if the PHP version is 8.0 or greater
function isPhpVersionValid() {
    return version_compare(PHP_VERSION, '8.0.0', '>=');
}
/**
 * Convert a string into a namespace format.
 *
 * @param string $string The input string to be converted.
 * @return string The namespaced string.
 */
function createNamespace($string) {
    // Replace spaces with underscores and remove non-alphanumeric characters
    $namespace = preg_replace('/[^a-zA-Z0-9_]/', '', str_replace(' ', '_', ucwords($string)));

    return $namespace;
}
// Function to recursively search and replace text in files
function searchReplaceInFiles($dir, $search, $replace) {
    $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir,RecursiveDirectoryIterator::SKIP_DOTS));

    /**
     * @var SplFileInfo $file
     */
    foreach ($files as $file) {
        // Skip the vendor directory
        if ((strpos($file->getRealPath(), DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR) !== false)
            ||
            strpos($file->getRealPath(), DIRECTORY_SEPARATOR . '.git' . DIRECTORY_SEPARATOR) !== false

        ) {
            continue;
        }

        //skip this file

        if($file->getFilename() ==="plugin-init.php"){
            continue;
        }

        if ( $file->isFile() && ($file->getExtension() === 'php' || $file->getExtension() === 'json')) {
            $content = file_get_contents($file->getRealPath());
            $content = str_replace($search, $replace, $content);
            file_put_contents($file->getRealPath(), $content);
        }
    }
}
function createSlug($string) {
    // Convert the string to lowercase
    $slug = strtolower($string);

    // Replace any non-alphanumeric characters (except for hyphens and underscores) with spaces
    $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug);

    // Replace multiple spaces or hyphens with a single hyphen
    $slug = preg_replace('/[\s-]+/', '-', $slug);

    // Trim hyphens from the beginning and end of the string
    $slug = trim($slug, '-');

    return $slug;
}
/**
 * Validate the PHP namespace pattern.
 *
 * @param string $namespace The namespace to validate.
 * @return bool True if the namespace is valid, false otherwise.
 */
function validateNamespace($namespace) {
    // A valid namespace can have alphanumeric characters and underscores, but cannot start with a number
    return preg_match('/^[a-zA-Z_][a-zA-Z0-9_\\\\]*$/', $namespace);
}


// Check if running in a Lando environment
if (!isLandoEnvironment()) {
    echo "This script must be run in a Lando environment.\n";
    exit(1);
}

// Check if PHP version is 8.0 or greater
if (!isPhpVersionValid()) {
    echo "This script requires PHP 8.0 or greater. Current version: " . PHP_VERSION . "\n";
    exit(1);
}




// Get inputs from the user
$pluginName = getInput("Enter Plugin Name");

$defaultNamespace = createNamespace($pluginName);
// Validate namespace input
do {
    $pluginNamespace =     $pluginNamespace = getInput("Enter Plugin Namespace", $defaultNamespace);
    if (!validateNamespace($pluginNamespace)) {
        echo "Invalid namespace pattern. The namespace must start with a letter or underscore and can contain letters, numbers, underscores, and backslashes.\n";
    }
} while (!validateNamespace($pluginNamespace));

$pluginDescription = getInput("Enter Plugin Description","This plugins handles the customizations provided by WPWhales.");

// Define the placeholders and their corresponding values
$placeholders = [
    '__PLUGIN_NAME__' => $pluginName,
    '__PLUGIN_SLUG__' => createSlug($pluginName),
    '__PLUGIN_NAMESPACE__' => $pluginNamespace,

    '__PLUGIN_DESCRIPTION__' => $pluginDescription,
];

// Directory to perform search and replace (assume script is in the plugin root)
$pluginDir = __DIR__;

// Perform the search and replace
foreach ($placeholders as $search => $replace) {
    searchReplaceInFiles($pluginDir, $search, $replace);
}

echo "Plugin initialization complete.\n";

// Run composer update to update dependencies and output the results in real-time
echo "Updating Composer dependencies...\n";

$process = popen('composer update 2>&1', 'r');
while (!feof($process)) {
    $output = fgets($process);
    echo $output;
}
pclose($process);

echo "Composer update completed.\n";

// Run composer dump-autoload to regenerate the autoload files
echo "Regenerating autoload files...\n";
exec('composer dump-autoload', $output, $return_var);

if ($return_var !== 0) {
    echo "Failed to run composer dump-autoload. Please check your Composer setup.\n";
} else {
    echo "Autoload files regenerated successfully.\n";
}
