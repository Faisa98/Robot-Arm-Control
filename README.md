# Robot Arm Control System

A web-based control system for a 6-motor robot arm with pose saving and loading capabilities.

## Demo


https://github.com/user-attachments/assets/d97d449e-653c-4969-b27b-f8b4953f7520



## Features

- Real-time control of 6 servo motors
- Slider-based interface (0-180 degrees)
- Save and load arm poses
- Remove saved poses
- Reset all motors to default position (90 degrees)
- Database-driven pose management

## Requirements

- XAMPP (or similar web server with PHP and MySQL)
- PHP 7.0 or higher
- MySQL 5.6 or higher
- Web browser with JavaScript enabled

## Database Setup

Create a database named `name` with the following tables:

```sql
CREATE TABLE `pose` (
  `ID` int(11) AUTO_INCREMENT PRIMARY KEY,
  `Motor 1` int(11),
  `Motor 2` int(11),
  `Motor 3` int(11),
  `Motor 4` int(11),
  `Motor 5` int(11),
  `Motor 6` int(11)
);

CREATE TABLE `run` (
  `ID` int(11) AUTO_INCREMENT PRIMARY KEY,
  `Motor 1` int(11),
  `Motor 2` int(11),
  `Motor 3` int(11),
  `Motor 4` int(11),
  `Motor 5` int(11),
  `Motor 6` int(11),
  `Status` int(11) DEFAULT 1
);
```

## Installation

1. Clone this repository to your XAMPP's htdocs folder:
```bash
git clone https://github.com/yourusername/robot-arm-control.git
```

2. Import the database structure using the SQL commands above

3. Access the control panel through your web browser:
```
http://localhost/robot-arm-control/control.php
```

## File Structure

- `control.php` - Main control interface and pose management
- `get_run_pose.php` - API endpoint for retrieving current pose
- `update_status.php` - Updates pose execution status

## Usage

1. Use the sliders to adjust each motor's position (0-180 degrees)
2. Click "Save pose" to store the current position
3. Click "Run" to execute the current position
4. Use "Load" to recall saved poses
5. Use "Remove" to delete saved poses
6. Click "Reset" to center all motors (90 degrees)
