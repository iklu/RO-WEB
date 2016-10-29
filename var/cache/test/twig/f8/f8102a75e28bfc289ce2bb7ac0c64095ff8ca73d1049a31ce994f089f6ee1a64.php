<?php

/* AppBundle:Default:index.html.twig */
class __TwigTemplate_8e7e2b1fed96781e0d9f7a40399599125bd8164268e40aec6d7a0a325575588f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("AppBundle::base.html.twig", "AppBundle:Default:index.html.twig", 1);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "AppBundle::base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_41bc6b7c59003de5478362da8fb18edeb24db924cb95f71c3a30796aec7916a0 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_41bc6b7c59003de5478362da8fb18edeb24db924cb95f71c3a30796aec7916a0->enter($__internal_41bc6b7c59003de5478362da8fb18edeb24db924cb95f71c3a30796aec7916a0_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Default:index.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_41bc6b7c59003de5478362da8fb18edeb24db924cb95f71c3a30796aec7916a0->leave($__internal_41bc6b7c59003de5478362da8fb18edeb24db924cb95f71c3a30796aec7916a0_prof);

    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        $__internal_494f63269372ce0811cecb0946cb5d56046bb08409ccb80c9b49a62efd40a437 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_494f63269372ce0811cecb0946cb5d56046bb08409ccb80c9b49a62efd40a437->enter($__internal_494f63269372ce0811cecb0946cb5d56046bb08409ccb80c9b49a62efd40a437_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "AppBundle:Default:index.html.twig"));

        echo "AppBundle:Default:index";
        
        $__internal_494f63269372ce0811cecb0946cb5d56046bb08409ccb80c9b49a62efd40a437->leave($__internal_494f63269372ce0811cecb0946cb5d56046bb08409ccb80c9b49a62efd40a437_prof);

    }

    // line 5
    public function block_body($context, array $blocks = array())
    {
        $__internal_42f3970c01b1e12f5a93bf006353a1797d39bdaaa5b5c085c8f1c8f358023daf = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_42f3970c01b1e12f5a93bf006353a1797d39bdaaa5b5c085c8f1c8f358023daf->enter($__internal_42f3970c01b1e12f5a93bf006353a1797d39bdaaa5b5c085c8f1c8f358023daf_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "AppBundle:Default:index.html.twig"));

        // line 6
        echo "<h1>Welcome to the Default:index page</h1>
";
        
        $__internal_42f3970c01b1e12f5a93bf006353a1797d39bdaaa5b5c085c8f1c8f358023daf->leave($__internal_42f3970c01b1e12f5a93bf006353a1797d39bdaaa5b5c085c8f1c8f358023daf_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Default:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  53 => 6,  47 => 5,  35 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"AppBundle::base.html.twig\" %}

{% block title %}AppBundle:Default:index{% endblock %}

{% block body %}
<h1>Welcome to the Default:index page</h1>
{% endblock %}
", "AppBundle:Default:index.html.twig", "/var/www/html/RO-WEB/src/AppBundle/Resources/views/Default/index.html.twig");
    }
}
