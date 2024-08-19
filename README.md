# WordPress Plugin Initialization Script

This repository provides a WordPress plugin template with an initialization script that automates the setup process by allowing you to input specific details like the plugin name, version, namespace, and more. This script also handles Composer dependencies and prepares the plugin for immediate use.

## Cloning the Repository

To clone this repository, you'll need to use a GitHub token for authentication. Follow the steps below:

1. **Generate a GitHub Token** (if you don't have one):
    - Go to [GitHub Personal Access Tokens](https://github.com/settings/tokens).
    - Generate a new token with the necessary scopes (e.g., `repo`).

2. **Clone the Repository**:
   ```bash
   cd /path/to/wordpress-plugins-directory
   git clone https://github.com/wpwhales/plugin-boilerplate.git plugin-name
   ```

Replace `<your-github-token>` with your actual GitHub token, `your-username` with your GitHub username, and `your-repo-name` with the name of the repository.

## Running the Plugin Initialization Script

After cloning the repository, you will need to SSH into the plugin directory using Lando. Lando is a development tool that provides local development environments.

### Steps:

1. **SSH into the Lando Environment**:
   ```bash
   lando ssh
   ```

2. **Navigate to the Plugin Directory**:
   ```bash
   cd /path/to/your-plugin-directory
   ```

3. **Run the Initialization Script**:
   ```bash
   php init-plugin.php
   ```

   The script will guide you through entering the plugin name, version, namespace, and other details. It will also handle Composer dependencies by running `composer update` and `composer dump-autoload`.

## Removing the Local `.git` Directory

After running the plugin initialization script, you'll need to remove the local `.git` directory. This step is necessary because we manage the Git repository globally in our Bedrock instance, not at the individual plugin level.

### Steps (using WSL):

1. **Open WSL** and navigate to the plugin directory:
   ```bash
   cd /path/to/your-plugin-directory
   ```

2. **Remove the `.git` Directory**:
   ```bash
   sudo rm -r .git
   ```

This command will delete the local `.git` directory, ensuring that the plugin is no longer tied to the repository cloned earlier.

## Why Remove the `.git` Directory?

In our setup, we manage version control for the entire application (including plugins) globally within a Bedrock instance. By removing the `.git` directory from individual plugins, we avoid conflicts and ensure that all code changes are tracked in the global repository.
