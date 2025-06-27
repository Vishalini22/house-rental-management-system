# House Rental Management System

A Laravel-based multi-role platform for managing rental properties. The system includes Admin, House Owner, and Customer roles. Admins control all core actions including user approvals, property listings, and booking coordination.

## How the System Works

1. **Customer Registration and Booking**  
   - Customers register via a form.  
   - Admin approves customers before they can access booking features.  
   - Customers can browse and book approved properties.

2. **House Owner Registration and Property Listing**  
   - House Owners register through a form.  
   - After Admin approval, they can submit property listings.  
   - Properties are shown to customers only after Admin approval.

3. **Booking Process**  
   - Booking requests go to the Admin.  
   - Admin shares booking details with the house owner.  
   - Owner and customer communicate to finalize the rental.

## Project Access Details

### Main Page (Customer and Owner View)

**URL:** http://127.0.0.1:8000/  
**Description:** Homepage where customers can browse and book properties, and approved house owners can log in to submit listings.

### Admin Dashboard

**URL:** http://127.0.0.1:8000/admin/login  
**Email:** vishavishalini@gmail.com  
**Password:** visha@22  
**Description:** Admin panel for managing user approvals, property listings, and booking coordination.

## Technologies Used

- Laravel (PHP)  
- MySQL  
- Tailwind CSS  
- Custom CSS  

