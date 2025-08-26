# GitHub Actions Workflows

This directory contains documentation for automated deployment workflows for TygartMedia projects.

## Available Workflows:
- `deploy-cloudflare.yml` - Deploys AI Models Worker and TygartMedia site to Cloudflare
- `deploy-wordpress.yml` - Deploys WordPress theme to TygartMedia WordPress site

## Workflow Locations:
All actual workflow files are located in `.github/workflows/` directory as required by GitHub Actions.

## Secrets Required:
### For Cloudflare Deployments:
- `CLOUDFLARE_API_TOKEN` - Cloudflare API token for deployments
- `CLOUDFLARE_ACCOUNT_ID` - Your Cloudflare account ID

### For WordPress Deployments:
- `WP_USERNAME` - WordPress admin username
- `WP_PASSWORD` - WordPress application password
- `GCP_SA_KEY` - Google Cloud service account key (if using GCP deployment)
