[![Code Climate](https://codeclimate.com/github/HiccupInsurance/sulu-blog-bundle/badges/gpa.svg)](https://codeclimate.com/github/HiccupInsurance/sulu-blog-bundle)

# sulu-blog-bundle
Sulu.io CMS BlogBundle

# Installation

```
composer require hiccup/sulu-blog-bundle
```

Add the bundle to AbstractKernel

```
new Hiccup\SuluBlogBundle\HicuppInsuranceSuluBlogBundle() 
```


# Contributor guides:

- Follow [PSR](http://www.php-fig.org/psr/) code style
- Entity table name prefix `hiccup_sulu_blog_`

# Tips:

- Use command and adjust as needed `composer update hiccup/sulu-blog-bundle --root-reqs --profile --no-dev -vvv --prefer-dist --no-scripts` to quickly update the package for testing