<?php
$data = [
    1 => [
        'name' => 'John',
        'age' => 30,
        'cars' => [
            'Ford',
            'BMW',
            'Fiat'
        ]

    ],
    2 => [
        'name' => 'Bob',
        'age' => 24,
        'cars' => [
            'Ford',
            'BMW',
            'Fiat'
        ]

    ]
];
switch ($_SERVER['REQUEST_METHOD']) {

    case 'GET':
        $query_string = $_SERVER['QUERY_STRING'];
        echo $query_string;

        $output = @$_GET['id'] ? $data[$_GET['id']] : $data; //validate the output here
        break;
    case POST:
        $output = 'POST';

        break;
    /*case HttpRequestMethod::PATCH:
        if ($mode === 'patch') {
            $this->update($request);
        } else if ($mode === 'resetPassword') {
            $this->resetPassword($request);
        } else {
            $this->getResponse()->setContent('unsupported resource request');
            $this->getResponse()->setStatusCode(HttpResponseCode::HTTP_BAD_REQUEST);
        }
        break;
    case HttpRequestMethod::DELETE:
        if ($mode === 'resetPassword') {
            $this->getResponse()->setContent('unsupported resource request');
            $this->getResponse()->setStatusCode(HttpResponseCode::HTTP_BAD_REQUEST);
        } else {
            $this->delete($request);
        }
        break;
    */
    default:
        $output = 'unsupported request method';
        break;


}
header('Content-Type: application/json');
echo json_encode($output);
