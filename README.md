[![Code Climate](https://codeclimate.com/github/HiccupInsurance/sulu-blog-bundle/badges/gpa.svg)](https://codeclimate.com/github/HiccupInsurance/sulu-blog-bundle)
[![Test Coverage](https://codeclimate.com/github/HiccupInsurance/sulu-blog-bundle/badges/coverage.svg)](https://codeclimate.com/github/HiccupInsurance/sulu-blog-bundle/coverage)
[![Issue Count](https://codeclimate.com/github/HiccupInsurance/sulu-blog-bundle/badges/issue_count.svg)](https://codeclimate.com/github/HiccupInsurance/sulu-blog-bundle)

# sulu-blog-bundle
Sulu.io CMS BlogBundle

# Installation

```
composer require hiccup/sulu-blog-bundle
```

Add the bundle to AbstractKernel

```
new Hiccup\SuluBlogBundle\HicuppSuluBlogBundle() 
```

Add routing to `app/config/admin/routing.yml`

```
hi_sulu_blog:
    resource: "@HiccupSuluBlogBundle/Resources/config/routing.yml"
```

Run migrations script or update your database after enable the bundle

# Contributor guides:

- Follow [PSR](http://www.php-fig.org/psr/) code style
- Entity table name prefix `hiccup_sulu_blog_`

# Tips:

- Use command and adjust as needed `composer update hiccup/sulu-blog-bundle --root-reqs --profile --no-dev -vvv --prefer-dist --no-scripts` to quickly update the package for testing