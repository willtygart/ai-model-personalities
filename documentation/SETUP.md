# TygartMedia Infrastructure Setup Guide

## Quick Start - Cloudflare Pages Deployment

### Step 1: Connect GitHub to Cloudflare Pages
1. Go to [Cloudflare Dashboard](https://dash.cloudflare.com)
2. Click on **Pages** in the left sidebar
3. Click **Create a project** → **Connect to Git**
4. Authorize GitHub and select `willtygart/ai-model-personalities`
5. Configure build settings:
   - **Production branch**: main
   - **Build command**: (leave empty)
   - **Build output directory**: cloudflare/tygartmedia
   - **Root directory**: /

### Step 2: Custom Domain Setup
Once deployed, add your custom domain:
1. In Pages project settings → Custom domains
2. Add `tygartmedia.com` and `www.tygartmedia.com`
3. Follow DNS configuration instructions

## WordPress Subdomain Configuration

### Option A: External WordPress Host
If using external WordPress hosting:
1. In Cloudflare DNS, add:
   - Type: CNAME
   - Name: wordpress
   - Target: [your-wordpress-host.com]
   - Proxy: OFF (DNS only)

### Option B: WordPress on Same Infrastructure
We can set up WordPress to run alongside:
1. Deploy WordPress files to `/wordpress/` directory
2. Create Worker to handle routing
3. Configure at `wordpress.tygartmedia.com`

## Directory Structure
```
/
├── cloudflare/
│   └── tygartmedia/        # Main site (Cloudflare Pages)
│       └── index.html      # Landing page
├── wordpress/              # WordPress files (future)
├── workflows/              # Automation scripts
└── documentation/          # This file and others
```

## Automatic Deployment
- Any push to `main` branch → Auto-deploys to Cloudflare Pages
- Changes in `/cloudflare/tygartmedia/` trigger rebuild
- WordPress updates can be synced via GitHub Actions

## Environment Variables Needed
Add these as repository secrets in GitHub:
- `CLOUDFLARE_API_TOKEN` - For deployments
- `CLOUDFLARE_ACCOUNT_ID` - Your account ID

## Support
- GitHub Issues: Track progress and problems
- Documentation: This directory
- Automation: Handled by AI assistant

---
*Infrastructure automated so you can focus on revenue generation*
