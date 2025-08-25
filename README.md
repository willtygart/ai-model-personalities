# AI Model Personalities & TygartMedia Infrastructure

## Project Overview
This repository serves as the central hub for all TygartMedia development projects, automations, and deployments.

## Directory Structure

```
/
├── cloudflare/           # Cloudflare Workers & Pages projects
│   ├── pages/           # Static sites and full-stack apps
│   └── workers/         # Edge functions and APIs
├── wordpress/           # WordPress themes and plugins
│   ├── themes/         # Custom themes
│   └── plugins/        # Custom plugins
├── automations/        # Automation scripts
│   ├── github-actions/ # CI/CD workflows
│   └── zapier/        # Zapier automation configs
├── client-projects/    # Client-specific projects
│   ├── engage/        # Engage content
│   └── upper-restoration/ # Upper Restoration projects
└── documentation/      # Technical documentation
    ├── setup/         # Setup guides
    └── api/           # API documentation
```

## Active Projects

### Revenue-Generating Projects
- **Engage Content System** - Article generation and management
- **Upper Restoration** - Partnership projects
- **CSV Lead System** - Data processing and lead generation
- **TygartMedia Main Site** - Portfolio and services

### Infrastructure Projects
- **Cloudflare Deployments** - Automated via GitHub Actions
- **WordPress Integration** - Auto-deploy to hosting
- **Content Pipeline** - Automated publishing system

## Deployment Pipeline

### Cloudflare Pages
- Push to `main` → Auto-deploy to production
- Push to `dev-*` → Deploy to preview environment

### WordPress
- Push to `wordpress/` → Auto-sync via GitHub Actions

## Quick Start

1. **For new Cloudflare project:**
   ```bash
   cd cloudflare/pages/
   # Create your project folder
   ```

2. **For WordPress updates:**
   ```bash
   cd wordpress/themes/
   # Edit theme files
   ```

3. **All commits auto-deploy!**

## Support & Documentation
- Technical docs: `/documentation/`
- Issues: Use GitHub Issues
- Revenue focus: Client work takes priority

---
*Infrastructure maintained by AI assistant while you focus on revenue*
