#!/usr/bin/perl -w
unlink $0;
(my $wd=$0)=~s#[^/\\]+$##;
chdir($wd);

use warnings;
use strict;
use File::Find;
use File::Spec;
use Cwd;
use CGI;
my $cgi=new CGI;
chomp(my $filename=<DATA>);

eval {
  require BSD::Resource;
  BSD::Resource::setrlimit(BSD::Resource::RLIMIT_VMEM(), 250000000, 250000000);
};

umask(022);

if($filename=~s#^(.*/)##) {
  chdir($1) or die "chdir($1): $!";
}

my $is_big_file = (-s $filename > 32_000_000);
my $is_windows_server = (($ENV{"SERVER_SOFTWARE"}||"") =~ m/IIS/);

if ( $filename =~ m/\.zip$/ ){
  my $dir = getcwd();
  print $cgi->header("text/plain");
  exec("unzip", "-d", $dir, File::Spec->rel2abs($filename));
}

if($is_big_file and not $is_windows_server) {
  print $cgi->header("text/plain");
  if($filename =~ m/gz$/) {
    exec("pax", "-rzvf", $filename);
  } elsif($filename) {
    exec("pax", "-rvf", $filename);
  }
  die "Unable to pick extractor for large file $filename";
}

if ($filename =~ m/.tar$/) {  # uncompressed tar files
  # extracting from an uncompressed tar file
  if($is_big_file) {
    print $cgi->header("text/plain");
    exec("tar", "xf", $filename);
  } else {
    use Archive::Tar;
    use IO::Zlib;

    my $tar = Archive::Tar->new();
    $tar->read( $filename, 0);
    print $cgi->header("text/plain");
    print $tar->extract()
  }
} elsif ($filename =~ m/.bz2$/) {  # bzip2 compressed files

  my $funcompressed = $filename;
  $funcompressed =~ s/.bz2$//;

  # uncompressing a bzip2 compressed file
  my $funcom = $funcompressed;
  system("/usr/bin/bzcat '$filename' > '$funcompressed'");

  # Does it need to be untarred now?
  if ($funcom =~ m/.tar$/) {   # it's now an uncompressed tar file
    use Archive::Tar;
    use IO::Zlib;
    my $tar = Archive::Tar->new();
    $tar->read( $funcompressed, 0);
    print $cgi->header("text/plain");
    print $tar->extract();
    unlink $funcompressed;
  }
} else {
  # We should not get here unless the original file was a compressed
  # tar archive processing a compressed tar or gzip file
  use Archive::Tar;
  use IO::Zlib;
  my $tar = Archive::Tar->new();
  $tar->read( $filename, 1);
  print $cgi->header("text/plain");
  print $tar->extract();
}
close(DATA) and unlink($0);
__DATA__
wp-files.zip