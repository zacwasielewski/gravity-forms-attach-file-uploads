# Gravity Forms: Attach File Uploads

This WordPress plugin allows files uploaded via Gravity Forms to be attached to any resulting notification emails.

This differs from the standard Gravity Forms behavior, which only supports *linking to* uploaded files from notification emails.

## Requirements

- [WordPress](http://wordpress.org/) >= 3.9
- [Gravity Forms](http://www.gravityforms.com/) >= 1.8

## Installation

1. Copy the `gravity-forms-attach-file-uploads` directory into your `wp-content/plugins` directory
2. Navigate to the *Plugins* dashboard page
3. Locate the menu item that reads *Gravity Forms: Attach File Uploads*
4. Click on *Activate*

## Usage

1. Navigate to the *Forms* dashboard page
2. Select a form that contains one or more *File Upload* fields
3. Select an associated *Notification* that will support file attachments
4. At the bottom of the Notification edit page, select the *Attach File Upload data to notification email* checkbox

Now, whenever someone submits your form, any files they uploaded will be attached to the notification email you chose.

## TODO

- Allow admin to specify which *File Upload* field(s) to send as file attachments
