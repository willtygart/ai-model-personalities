// AI Model Personalities Showcase Worker - Fully Accessible & AI Agent Optimized
export default {
  async fetch(request, env, ctx) {
    const url = new URL(request.url);
    
    // Handle CORS for all requests
    const corsHeaders = {
      'Access-Control-Allow-Origin': '*',
      'Access-Control-Allow-Methods': 'GET, OPTIONS',
      'Access-Control-Allow-Headers': 'Content-Type',
    };

    if (request.method === 'OPTIONS') {
      return new Response(null, { headers: corsHeaders });
    }

    // Model data with comprehensive metadata
    const models = {
      mistral: {
        id: "mistral-saba",
        name: "Mistral Saba",
        tagline: "The Cultural Bridge Builder",
        emoji: "🌍",
        company: "Mistral AI",
        location: "France",
        founded: "2023",
        parameters: "24B",
        languages: ["Arabic", "Tamil", "Malayalam", "English"],
        story: "Born from French AI pioneers at Mistral who recognized that most AI was trained on Western content, leaving entire cultures underserved. A 24B parameter model specifically trained on Arabic dialects, Tamil, and Malayalam - languages of the heart.",
        culturalDna: {
          philosophy: "Cultural cross-pollination between Middle East and South Asia",
          performance: "Outperforms models 5x larger in regional accuracy", 
          speed: "150+ tokens/second on single GPU",
          training: "Meticulously curated datasets from Middle East and South Asia"
        },
        useCases: [
          "Client has Middle Eastern or South Asian heritage",
          "Project needs authentic cultural voice, not just translation",
          "Marketing materials for multicultural audiences",
          "When authenticity matters more than raw power"
        ],
        clientStory: "For your Dubai hotel's content, we used Mistral Saba - a model specifically trained to understand Arabic cultural expressions and South Asian hospitality traditions. It doesn't just translate; it thinks in your cultural context.",
        technicalSpecs: {
          architecture: "Transformer",
          contextLength: "32K tokens",
          trainingData: "Curated multilingual datasets",
          license: "Custom Commercial License"
        }
      },
      deepseek: {
        id: "deepseek",
        name: "DeepSeek",
        tagline: "The Underdog Innovator", 
        emoji: "🚀",
        company: "DeepSeek AI",
        location: "China",
        founded: "2023",
        founder: "Liang Wenfeng",
        story: "Founded by Liang Wenfeng, a successful hedge fund trader who chose research over comfort. Started as a side project in 2023, now challenging Silicon Valley giants with the philosophy of 'unraveling the mystery of AGI with curiosity.'",
        culturalDna: {
          innovation: "Built world-class models with restricted resources",
          talent: "Hires fresh graduates for ability, not experience", 
          commitment: "MIT License, truly open research",
          philosophy: "Constraints breed the best innovation"
        },
        useCases: [
          "Client appreciates underdog/bootstrap stories",
          "Startup or entrepreneurial clients",
          "When you want to demonstrate creativity beats brute force",
          "Reasoning-heavy tasks requiring unique architecture"
        ],
        clientStory: "We used DeepSeek for your analysis - it's created by a former trader who believes constraints breed the best innovation. Like your startup, they prove you don't need the biggest budget to create world-changing results.",
        technicalSpecs: {
          architecture: "Mixture of Experts (MoE)",
          trainingCost: "$6 million",
          license: "MIT License",
          speciality: "Reasoning and efficiency"
        }
      },
      qwen: {
        id: "qwen-alibaba",
        name: "Qwen (Alibaba)",
        tagline: "The Global Commerce Democratizer",
        emoji: "🌐", 
        company: "Alibaba Cloud",
        location: "China",
        founded: "2023",
        userBase: "930+ million users",
        story: "Built by Alibaba with the philosophy 'make AI accessible to all.' Trained on data from 930+ million users across global marketplaces, representing the world's largest e-commerce AI brain with support for 119 languages.",
        culturalDna: {
          mission: "Make it easy to do business anywhere",
          reach: "119 languages and dialects",
          training: "Real-world business interactions from global commerce",
          philosophy: "AI democratization and accessibility"
        },
        useCases: [
          "International business or e-commerce clients",
          "Multilingual projects requiring global perspective",
          "Clients who value accessibility and democratization", 
          "Projects connecting different cultures and markets"
        ],
        clientStory: "For your global marketplace, we're using Qwen - Alibaba's AI that understands 119 languages and was trained on real commerce data from nearly a billion users worldwide. It thinks like a global business, not just a language model.",
        technicalSpecs: {
          architecture: "Hybrid Transformer",
          languages: 119,
          trainingTokens: "36 trillion",
          license: "Apache 2.0"
        }
      },
      cohere: {
        id: "cohere-command",
        name: "Cohere Command",
        tagline: "The Prodigy's Enterprise Vision",
        emoji: "🍁",
        company: "Cohere",
        location: "Canada", 
        founded: "2019",
        founder: "Aidan Gomez",
        founderAge: "20 (when co-authored transformer paper)",
        story: "Created by Aidan Gomez, a 20-year-old intern at Google Brain who co-authored 'Attention Is All You Need' - the transformer paper that literally created the foundation for ChatGPT and the entire AI revolution.",
        culturalDna: {
          philosophy: "Make Google-level AI accessible to everyone",
          innovation: "Canadian startup proving Toronto can compete with Silicon Valley",
          focus: "Enterprise-grade solutions, not viral consumer apps",
          legacy: "Co-invented the transformer architecture"
        },
        useCases: [
          "Client appreciates young genius/prodigy stories",
          "Canadian companies wanting to support local innovation",
          "Enterprise clients needing serious, business-focused AI",
          "When emphasizing innovation outside Silicon Valley"
        ],
        clientStory: "We're using Cohere Command for your enterprise solution - it's created by Aidan Gomez, the 20-year-old Canadian who literally co-authored the research paper that made ChatGPT possible. He left Google to bring enterprise-grade AI to companies like yours.",
        technicalSpecs: {
          architecture: "Transformer (original co-inventor)",
          focus: "Enterprise RAG and search",
          deployment: "Cloud-agnostic",
          valuation: "$5.5 billion"
        }
      }
    };

    // Individual model pages
    if (url.pathname.startsWith('/model/')) {
      const modelId = url.pathname.split('/')[2];
      const model = Object.values(models).find(m => m.id === modelId);
      
      if (!model) {
        return new Response('Model not found', { status: 404 });
      }

      return new Response(generateModelPage(model), {
        headers: { ...corsHeaders, 'Content-Type': 'text/html' }
      });
    }

    // API endpoint to get model data
    if (url.pathname === '/api/models') {
      return new Response(JSON.stringify(models), {
        headers: { ...corsHeaders, 'Content-Type': 'application/json' }
      });
    }

    // Serve the main homepage
    return new Response(generateHomepage(models), {
      headers: { ...corsHeaders, 'Content-Type': 'text/html' }
    });
  }
};

function generateModelPage(model) {
  const structuredData = {
    "@context": "https://schema.org",
    "@type": "SoftwareApplication",
    "name": model.name,
    "description": model.story,
    "applicationCategory": "Artificial Intelligence",
    "operatingSystem": "Cloud-based",
    "creator": {
      "@type": "Organization",
      "name": model.company,
      "location": model.location
    },
    "offers": {
      "@type": "Offer",
      "description": "AI Model Curation Service",
      "category": "Enterprise AI Solutions"
    },
    "keywords": [
      "artificial intelligence",
      "machine learning",
      "natural language processing",
      ...model.languages || [],
      model.company.toLowerCase(),
      "ai curation",
      "cultural ai"
    ],
    "audience": {
      "@type": "Audience",
      "audienceType": "Business, Enterprise, Developers"
    }
  };

  return `<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>${model.name} - ${model.tagline} | AI Model Personalities</title>
    <meta name="description" content="${model.story.substring(0, 160)}...">
    <meta name="keywords" content="AI model, ${model.name}, ${model.company}, artificial intelligence, machine learning">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://ai-models.tygartmedia.com/model/${model.id}">
    <meta property="og:title" content="${model.name} - ${model.tagline}">
    <meta property="og:description" content="${model.story.substring(0, 160)}...">
    <meta property="og:image" content="https://ai-models.tygartmedia.com/og-image-${model.id}.jpg">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://ai-models.tygartmedia.com/model/${model.id}">
    <meta property="twitter:title" content="${model.name} - ${model.tagline}">
    <meta property="twitter:description" content="${model.story.substring(0, 160)}...">
    <meta property="twitter:image" content="https://ai-models.tygartmedia.com/og-image-${model.id}.jpg">

    <!-- Accessibility & SEO -->
    <link rel="canonical" href="https://ai-models.tygartmedia.com/model/${model.id}">
    <meta name="robots" content="index, follow">
    <meta name="language" content="en-US">
    <meta name="revisit-after" content="7 days">
    <meta name="author" content="Tygart Media - AI Model Curation Service">

    <!-- Schema.org JSON-LD -->
    <script type="application/ld+json">
    ${JSON.stringify(structuredData, null, 2)}
    </script>

    <!-- Rest of the HTML and CSS... -->
    <style>
        /* Complete CSS styling here - truncated for brevity */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; color: #333; line-height: 1.6; }
        /* ... full CSS would go here ... */
    </style>
</head>
<body>
    <!-- Full HTML template here -->
</body>
</html>`;
}

function generateHomepage(models) {
  // Homepage HTML generation function
  return `<!DOCTYPE html><html><!-- Full homepage HTML --></html>`;
}
