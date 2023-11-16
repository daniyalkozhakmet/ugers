<?php

namespace Controller;

use Aws\S3\Exception\S3Exception;
use Aws\S3\S3Client;

defined('ROOTPATH') or exit('Access Denied!');

class AWS
{

    public function initialize()
    {
        $s3 = new S3Client([
            'version' => VERSION,
            'region' => REGION,
            'credentials' => [
                'key' => ACCESSKEYID,
                'secret' => SECRETACCESSKEY,
            ]
        ]);
        return $s3;
    }
    public function putObject($file_src, $file_name, $type = '')
    {
        $response = [];
        try {
            $result = $this->initialize()->putObject([
                'Bucket' => BUCKET,
                'Key' => $file_name,
                'ACL' => 'public-read',
                'SourceFile' => $file_src,
                'ContentType' => $type,
            ]);
            $result_arr = $result->toArray();
            if (!empty($result_arr['ObjectURL'])) {
                $s3_file_link = $result_arr['ObjectURL'];
                $response += array('link' => $s3_file_link);
            } else {
                $api_err = 'FAIL';
            }
        } catch (S3Exception $e) {
            $api_err = $e->getMessage();
            //throw $th;
        }
        if (empty($api_err)) {
            $status = 'success';
            $statusMsg = 'Uploaded';
        } else {
            $statusMsg = $api_err;
            $status = [$file_name => 'Errorrr'];
        }
        $response += array('status' => $status);
        $response += array('message' => $statusMsg);
        return $response;
    }
}
