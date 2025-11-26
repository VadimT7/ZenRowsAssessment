# ZenRows Configuration Selector

A fullstack application for selecting and saving Origin-Destination configuration pairs for web scraping jobs.

## 🎯 Overview

This application allows users to:
- View available scraping origins (Zillow, Redfin, Trulia, Realtor)
- View available destinations (Amazon S3, MySQL, MongoDB, PostgreSQL)
- Select one origin and one destination to create a configuration pair
- Save multiple configuration pairs that persist across page reloads
- Delete saved configurations

## 🛠️ Tech Stack

### Backend
- **Laravel 11** - PHP framework with clean architecture
- **SQLite** - Lightweight database (perfect for Dockerized setup)
- **RESTful API** - Clean endpoints for CRUD operations

### Frontend
- **Vue 3** - Composition API with `<script setup>` syntax
- **Vite** - Fast build tool and dev server
- **Tailwind CSS** - Utility-first CSS framework for pixel-perfect design
- **Single File Components** - Organized, maintainable code

### Infrastructure
- **Docker & Docker Compose** - One-command setup
- **CORS configured** - Frontend-backend communication ready

## 🚀 Quick Start

### Prerequisites
- Docker and Docker Compose installed on your system

### Running the Application

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd ZenRowsAssignment
   ```

2. **Start the application**
   ```bash
   docker-compose up --build
   ```

3. **Access the application**
   - Frontend: http://localhost:5173
   - Backend API: http://localhost:8000

That's it! The Docker setup handles everything:
- Installing PHP dependencies
- Installing Node.js dependencies
- Creating and migrating the SQLite database
- Seeding the database with test data
- Starting both servers

### Stopping the Application
```bash
docker-compose down
```

## 📁 Project Structure

```
├── docker-compose.yml          # Docker orchestration
├── test-data.json              # Sample data for seeding
├── README.md
│
├── backend/                    # Laravel 11 API
│   ├── Dockerfile
│   ├── app/
│   │   ├── Http/Controllers/
│   │   │   ├── OriginController.php
│   │   │   ├── DestinationController.php
│   │   │   └── ConfigurationController.php
│   │   └── Models/
│   │       ├── Origin.php
│   │       ├── Destination.php
│   │       └── Configuration.php
│   ├── database/
│   │   ├── migrations/
│   │   └── seeders/
│   └── routes/api.php
│
└── frontend/                   # Vue 3 SPA
    ├── Dockerfile
    ├── src/
    │   ├── App.vue             # Main application component
    │   ├── components/
    │   │   ├── Header.vue
    │   │   ├── Footer.vue
    │   │   ├── SelectionCard.vue
    │   │   ├── OriginList.vue
    │   │   ├── DestinationList.vue
    │   │   ├── ConfigurationList.vue
    │   │   └── UrlScraper.vue
    │   ├── main.js
    │   └── style.css
    └── index.html
```

## 🔌 API Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/origins` | Get all available origins |
| GET | `/api/destinations` | Get all available destinations |
| GET | `/api/configurations` | Get all saved configurations |
| POST | `/api/configurations` | Create a new configuration |
| DELETE | `/api/configurations/{id}` | Delete a configuration |

### Example API Requests

**Create Configuration:**
```bash
curl -X POST http://localhost:8000/api/configurations \
  -H "Content-Type: application/json" \
  -d '{"origin_id": 1, "destination_id": 1}'
```

**Get All Configurations:**
```bash
curl http://localhost:8000/api/configurations
```

## 🎨 UI Features

- **Single Selection Behavior**: Click to select, click again to deselect
- **Visual Feedback**: Selected items have a purple border with subtle shadow
- **Disabled State**: Save button is muted coral when not both selections are made
- **Active State**: Save button turns green when both origin and destination are selected
- **Success Message**: Green confirmation after saving
- **Saved List**: All configurations display below the selection area with delete option

## 📝 Technical Decisions

### Why SQLite?
- Zero configuration - no extra Docker service needed
- Perfect for MVP and development
- Easy to migrate to MySQL/PostgreSQL for production

### Why Composition API?
- Better TypeScript support (future-proofing)
- More flexible code organization
- Cleaner separation of concerns
- Industry standard for Vue 3 projects

### Why Tailwind CSS?
- Rapid prototyping and pixel-perfect design matching
- Consistent design system
- Small production bundle (purges unused styles)
- Excellent for component-based architecture

### Component Architecture
- **SelectionCard**: Reusable card component for both origins and destinations
- **OriginList/DestinationList**: Wrapper components for organization
- **ConfigurationList**: Bonus feature - displays saved pairs
- Separation allows easy extension for future requirements

## 🔄 Future Extensions

The codebase is designed for easy extension:

1. **Custom Origins/Destinations**
   - Add `POST /api/origins` and `POST /api/destinations` endpoints
   - Add create forms to the UI

2. **User Authentication**
   - Laravel Sanctum is ready to integrate
   - Add user_id foreign key to configurations

3. **Configuration Categories**
   - Add a categories table
   - Group configurations by type

4. **Real-time Updates**
   - Add Laravel Echo and WebSockets
   - Update UI without page refresh

## 🐛 Troubleshooting

### Port Already in Use
```bash
# Find and kill the process using port 8000 or 5173
docker-compose down
docker-compose up --build
```

### Database Issues
```bash
# Reset the database
docker-compose exec backend php artisan migrate:fresh --seed
```

### Frontend Not Loading
```bash
# Rebuild frontend container
docker-compose up --build frontend
```

## 📄 License

MIT License - Feel free to use this code for learning and development.

---

Built with ❤️ for ZenRows Technical Assessment

