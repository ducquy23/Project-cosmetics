#!/bin/bash

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

echo -e "${BLUE}🚀 FuelPHP Docker Setup Script${NC}"
echo "=================================="

# Check if Docker is installed
if ! command -v docker &> /dev/null; then
    echo -e "${RED}❌ Docker is not installed. Please install Docker first.${NC}"
    exit 1
fi

# Check if Docker Compose V2 is available (docker compose)
if ! docker compose version &> /dev/null; then
    echo -e "${RED}❌ Docker Compose V2 not found. Please install/update Docker Desktop (Compose V2).${NC}"
    exit 1
fi

echo -e "${GREEN}✅ Docker and Docker Compose (V2) are installed${NC}"

# Create necessary directories
echo -e "${YELLOW}📁 Creating necessary directories...${NC}"
mkdir -p docker/ngnix
mkdir -p docker/php
mkdir -p docker/mysql
mkdir -p public/uploads
mkdir -p fuel/app/cache
mkdir -p fuel/app/logs
mkdir -p fuel/app/tmp

# Set permissions
echo -e "${YELLOW}🔐 Setting permissions...${NC}"
chmod -R 777 fuel/app/cache
chmod -R 777 fuel/app/logs
chmod -R 777 fuel/app/tmp
chmod -R 777 public/uploads

# Build and start containers (Compose V2)
echo -e "${YELLOW}🔨 Building and starting containers...${NC}"
docker compose down
docker compose build --no-cache
docker compose up -d

# Wait for MySQL to be ready
echo -e "${YELLOW}⏳ Waiting for MySQL to be ready...${NC}"
sleep 30

# Check if containers are running
echo -e "${YELLOW}🔍 Checking container status...${NC}"
docker compose ps

# Run Laravel migrations
echo -e "${YELLOW}🗄️ Running Laravel migrations...${NC}"
docker compose exec php php artisan migrate --force

# Install dependencies
echo -e "${YELLOW}📦 Installing Composer dependencies...${NC}"
docker compose exec php composer install

# Set up environment
echo -e "${YELLOW}⚙️ Setting up environment...${NC}"
if [ ! -f .env ]; then
    cp .env.example .env 2>/dev/null || echo "No .env.example found"
fi

echo -e "${GREEN}🎉 Setup completed successfully!${NC}"
echo ""
echo -e "${BLUE}📋 Access URLs:${NC}"
echo -e "  🌐 Website: http://localhost:8001"
echo -e "  🗄️ phpMyAdmin: http://localhost:8080"
echo ""
echo -e "${BLUE}📋 Useful Commands:${NC}"
echo -e "  🚀 Start: docker compose up -d"
echo -e "  🛑 Stop: docker compose down"
echo -e "  📊 Logs: docker compose logs -f"
echo -e "  🔧 Shell: docker compose exec php bash"
echo -e "  🗄️ DB Shell: docker compose exec mysql mysql -u laravel -p laravel"
echo ""
echo -e "${GREEN}✨ Happy coding!${NC}"
