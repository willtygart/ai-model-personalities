# WordPress Deployment for TygartMedia

This repository contains the deployment pipeline for wordpress.tygartmedia.com

## Current Status
- ✅ WordPress Site: https://wordpress.tygartmedia.com
- ✅ GitHub Repository: willtygart/ai-model-personalities
- ✅ MCP Integration: WordPress API connected
- 🔄 CI/CD Pipeline: In Progress

## Deployment Strategy

### Automatic Deployment
- **Trigger**: Push to `main` branch
- **Target**: wordpress.tygartmedia.com
- **Method**: WordPress REST API + Direct file deployment

### Required Secrets
Add these to GitHub repository secrets:
- `WP_USERNAME`: WordPress admin username
- `WP_PASSWORD`: WordPress application password
- `GCP_SA_KEY`: Google Cloud service account key

### File Structure
```
/
├── .github/
│   └── workflows/
│       └── deploy-wordpress.yml
├── wordpress/
│   ├── themes/
│   │   └── tygartmedia-theme/
│   ├── plugins/
│   │   └── tygartmedia-functionality/
│   └── content/
│       ├── pages/
│       └── posts/
└── README.md
```

## Getting Started

1. **Set up WordPress credentials**
2. **Configure GitHub secrets**  
3. **Push changes to trigger deployment**
4. **Monitor deployment in Actions tab**

## Next Steps
- [ ] Complete GitHub Actions workflow
- [ ] Set up WordPress application passwords
- [ ] Configure Google Cloud deployment
- [ ] Test deployment pipeline
- [ ] Add staging environment

Last updated: August 2025