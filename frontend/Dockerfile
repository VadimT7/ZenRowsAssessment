FROM node:20-alpine

# Set working directory
WORKDIR /app

# Copy package files
COPY package*.json ./

# Install dependencies
RUN npm install

# Copy project files
COPY . .

# Expose port 5173 for Vite dev server
EXPOSE 5173

# Start Vite dev server with host binding for Docker access
CMD ["npm", "run", "dev", "--", "--host", "0.0.0.0"]
