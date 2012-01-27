from setuptools import setup, find_packages

version = '0.1-dev'

setup(name='fotochest',
      version=version,
      description="Photo sharing application",
      long_description=open("README.md", "r").read(),
      classifiers=[
          "Development Status :: 3 - Alpha",
          "Environment :: Web Environment",
          "Intended Audience :: End Users/Desktop",
          "Natural Language :: English",
          "Operating System :: OS Independent",
          "Programming Language :: Python",
          "Topic :: Internet :: WWW/HTTP :: Dynamic Content :: CGI Tools/Libraries",
          "Topic :: Utilities",
          "License :: OSI Approved :: MIT License",
          ],
      keywords='photos',
      author='Derek Stegelman',
      author_email='dstegelman@gmail.com',
      url='http://github.com/fotochest/fotochest',
      license='MIT',
      packages=find_packages(),
      include_package_data=True,
      zip_safe=False,
    )