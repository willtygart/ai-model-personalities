#!/bin/bash

# TygartMedia Quick Deploy Script
# This script helps deploy updates to Cloudflare Pages

echo "🚀 TygartMedia Deployment Helper"
echo "================================"

# Check if we're in the right directory
if [ ! -d "cloudflare/tygartmedia" ]; then
    echo "❌ Error: cloudflare/tygartmedia directory not found"
    echo "Please run this script from the repository root"
    exit 1
fi

# Function to deploy to Cloudflare Pages
deploy_cloudflare() {
    echo "📦 Deploying to Cloudflare Pages..."
    
    # Check if wrangler is installed
    if ! command -v wrangler &> /dev/null; then
        echo "Installing Wrangler CLI..."
        npm install -g wrangler
    fi
    
    # Deploy to Cloudflare Pages
    wrangler pages deploy cloudflare/tygartmedia --project-name=tygartmedia
    
    if [ $? -eq 0 ]; then
        echo "✅ Successfully deployed to Cloudflare Pages!"
        echo "🌐 Your site will be available at:"
        echo "   https://tygartmedia.pages.dev"
        echo "   https://tygartmedia.com (once DNS is configured)"
    else
        echo "❌ Deployment failed. Please check the errors above."
    fi
}

# Function to push to GitHub (which triggers auto-deploy)
push_to_github() {
    echo "📤 Pushing to GitHub (triggers auto-deploy)..."
    
    git add .
    git commit -m "Update TygartMedia site content"
    git push origin main
    
    if [ $? -eq 0 ]; then
        echo "✅ Pushed to GitHub successfully!"
        echo "⏳ Cloudflare Pages will auto-deploy in a few minutes"
    else
        echo "❌ Git push failed. Please check your connection."
    fi
}

# Menu
echo ""
echo "Choose deployment method:"
echo "1) Direct deploy to Cloudflare Pages (manual)"
echo "2) Push to GitHub (auto-deploy)"
echo "3) Both"
echo ""
read -p "Enter choice [1-3]: " choice

case $choice in
    1)
        deploy_cloudflare
        ;;
    2)
        push_to_github
        ;;
    3)
        push_to_github
        echo ""
        deploy_cloudflare
        ;;
    *)
        echo "Invalid choice. Exiting."
        exit 1
        ;;
esac

echo ""
echo "🎉 Deployment process complete!"
echo "Remember: You're focusing on revenue while automation handles deployment!"
