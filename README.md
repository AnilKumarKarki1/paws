# Paws and Claws Rescue

## Description
**Paws and Claws Rescue** is a pet rescue and adoption website designed to help users adopt pets, learn about pet care, and explore various FAQs related to pets. It includes an admin panel to manage pets, FAQs, and adoption requests.

## Project Structure
The project is organized as follows:

### 1. **Actions** (`/actions/`)
Contains PHP scripts that handle various form submissions and requests for the website, including:
- **create\_actions**: For creating various entities (pet, FAQ, adoption request).
- **delete\_actions**: For deleting entities.
- **update\_actions**: For updating the details of entities.
- **get\_details**: Fetches details for specific entities (company, pet, FAQ).
- **Authentication actions**: Login, register, logout, etc.

### 2. **Config** (`/config/`)
Contains configuration files for database connections and settings.

### 3. **Public** (`/public/`)
- **assets**: Stores static files such as images, CSS, and JavaScript.
- **uploads**: Contains uploaded files, such as pet photos.
- **views**: Holds all user-facing pages of the website, including pages for:
  - **Adoption**: List and manage pets available for adoption.
  - **Company**: Information about the rescue organization.
  - **FAQ**: Frequently asked questions related to adoption and pet care.
  - **Subscription**: Pages for user subscriptions.

### 4. **Admin** (`/admin/`)
Contains admin dashboard pages to manage the website content:
- **Layout**: Common layout components like the header and footer for the admin section.
- **Pages**: Includes pages for managing pets, FAQs, users, and more.

### 5. **Layout** (`/layout/`)
The common layout components for the user-facing part of the website:
- **header.php**: Sitewide header navigation.
- **footer.php**: Sitewide footer with contact and social links.
- **navbar.php**: Navigation bar for various pages like adoption, FAQs, etc.

### 6. **404 Page** (`404.php`)
Custom 404 error page for the website.

### 7. **Index Pages**
- **index.php**: Main homepage of the website.
- **admin/index.php**: Main dashboard page for the admin section.

## Setup Instructions

### 1. **Clone the repository**
```sh
git clone https://github.com/AnilKumarKarki1/paws.git
git checkout dynamic
cd paws
```

### 2. **import sql file to database**
create a database named website & import the paws.sql file which will create necessary file along with some initial data

### 2. **Local Build*
In the root directory
```sh
php -S localhost:8000  
```


## External Links
- for images in directory public/assets/images -> https://drive.google.com/drive/folders/1yf7lyFptEzHB_9c7NX7i2Fg2QJSbcL6e

## Impportant note 
- contains group website report and my individual report