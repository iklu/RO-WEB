<?php

/* @Twig/Exception/exception_full.html.twig */
class __TwigTemplate_67220f523dfacf6a675f18c64fe09e7e904653366104b9412dcdaf9c918c5522 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@Twig/layout.html.twig", "@Twig/Exception/exception_full.html.twig", 1);
        $this->blocks = array(
            'head' => array($this, 'block_head'),
            'title' => array($this, 'block_title'),
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@Twig/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_09c556071d45141a2addc3bb70762ffb8b5fed708f540d861ced89e0f5dfe973 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_09c556071d45141a2addc3bb70762ffb8b5fed708f540d861ced89e0f5dfe973->enter($__internal_09c556071d45141a2addc3bb70762ffb8b5fed708f540d861ced89e0f5dfe973_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Twig/Exception/exception_full.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_09c556071d45141a2addc3bb70762ffb8b5fed708f540d861ced89e0f5dfe973->leave($__internal_09c556071d45141a2addc3bb70762ffb8b5fed708f540d861ced89e0f5dfe973_prof);

    }

    // line 3
    public function block_head($context, array $blocks = array())
    {
        $__internal_408956f3fc983c26cb36cb2c59dc58d5298c6e3497e2cd555f5cc0979ab0832c = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_408956f3fc983c26cb36cb2c59dc58d5298c6e3497e2cd555f5cc0979ab0832c->enter($__internal_408956f3fc983c26cb36cb2c59dc58d5298c6e3497e2cd555f5cc0979ab0832c_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "@Twig/Exception/exception_full.html.twig"));

        // line 4
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\HttpFoundationExtension')->generateAbsoluteUrl($this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("bundles/framework/css/exception.css")), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />
";
        
        $__internal_408956f3fc983c26cb36cb2c59dc58d5298c6e3497e2cd555f5cc0979ab0832c->leave($__internal_408956f3fc983c26cb36cb2c59dc58d5298c6e3497e2cd555f5cc0979ab0832c_prof);

    }

    // line 7
    public function block_title($context, array $blocks = array())
    {
        $__internal_2a91045985601093a7105313fd64d99c3d055aa5951e7b2e43fd5bfbe8f00442 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_2a91045985601093a7105313fd64d99c3d055aa5951e7b2e43fd5bfbe8f00442->enter($__internal_2a91045985601093a7105313fd64d99c3d055aa5951e7b2e43fd5bfbe8f00442_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "@Twig/Exception/exception_full.html.twig"));

        // line 8
        echo "    ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["exception"]) ? $context["exception"] : $this->getContext($context, "exception")), "message", array()), "html", null, true);
        echo " (";
        echo twig_escape_filter($this->env, (isset($context["status_code"]) ? $context["status_code"] : $this->getContext($context, "status_code")), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, (isset($context["status_text"]) ? $context["status_text"] : $this->getContext($context, "status_text")), "html", null, true);
        echo ")
";
        
        $__internal_2a91045985601093a7105313fd64d99c3d055aa5951e7b2e43fd5bfbe8f00442->leave($__internal_2a91045985601093a7105313fd64d99c3d055aa5951e7b2e43fd5bfbe8f00442_prof);

    }

    // line 11
    public function block_body($context, array $blocks = array())
    {
        $__internal_1d81643baca099c47998beda8a5623012cac3ebd3ba2c8c388a8c5cec6b4376f = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_1d81643baca099c47998beda8a5623012cac3ebd3ba2c8c388a8c5cec6b4376f->enter($__internal_1d81643baca099c47998beda8a5623012cac3ebd3ba2c8c388a8c5cec6b4376f_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "@Twig/Exception/exception_full.html.twig"));

        // line 12
        echo "    ";
        $this->loadTemplate("@Twig/Exception/exception.html.twig", "@Twig/Exception/exception_full.html.twig", 12)->display($context);
        
        $__internal_1d81643baca099c47998beda8a5623012cac3ebd3ba2c8c388a8c5cec6b4376f->leave($__internal_1d81643baca099c47998beda8a5623012cac3ebd3ba2c8c388a8c5cec6b4376f_prof);

    }

    public function getTemplateName()
    {
        return "@Twig/Exception/exception_full.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  78 => 12,  72 => 11,  58 => 8,  52 => 7,  42 => 4,  36 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends '@Twig/layout.html.twig' %}

{% block head %}
    <link href=\"{{ absolute_url(asset('bundles/framework/css/exception.css')) }}\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />
{% endblock %}

{% block title %}
    {{ exception.message }} ({{ status_code }} {{ status_text }})
{% endblock %}

{% block body %}
    {% include '@Twig/Exception/exception.html.twig' %}
{% endblock %}
", "@Twig/Exception/exception_full.html.twig", "/var/www/html/RO-WEB/vendor/symfony/symfony/src/Symfony/Bundle/TwigBundle/Resources/views/Exception/exception_full.html.twig");
    }
}
