<?php

namespace App\Traits;

use Illuminate\Http\Response;
use Illuminate\Support\Collection;

trait ApiResponser
{
    /**
     * Building success response
     *
     * @param  int  $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function response(string $msg, int $code = Response::HTTP_OK, array|Collection $data = [], bool $includeCodeInStatus = false)
    {
        $resPhrase = '';
        $resStatus = '';
        switch ($code) {
            /**
             * The server cannot or will not process the request due to
             * something that is perceived to be a client error (e.g.,
             * malformed request syntax, invalid request message framing,
             * or deceptive request routing).
             */
            case Response::HTTP_BAD_REQUEST:
                $resPhrase = 'Bad Request';
                $resStatus = 'fail';
                break;
                /**
                 * Although the HTTP standard specifies "unauthorized", semantically
                 * this response means "unauthenticated". That is, the client must
                 * authenticate itself to get the requested response.
                 */
            case Response::HTTP_UNAUTHORIZED:
                $resPhrase = 'Unauthorized';
                $resStatus = 'fail';
                break;
                /**
                 * This response code is reserved for future use. The initial aim for creating
                 *  this code was using it for digital payment systems, however this status code
                 *  is used very rarely and no standard convention exists.
                 */
            case Response::HTTP_PAYMENT_REQUIRED:
                $resPhrase = 'Payment Required';
                $resStatus = 'fail';
                break;
                /**
                 * The client does not have access rights to the content; that is, it is unauthorized,
                 *  so the server is refusing to give the requested resource. Unlike 401 Unauthorized,
                 *  the client's identity is known to the server.
                 */
            case Response::HTTP_FORBIDDEN:
                $resPhrase = 'Forbidden';
                $resStatus = 'fail';
                break;
                /**
                 * The server cannot find the requested resource. In the browser, this means the URL is
                 * not recognized. In an API, this can also mean that the endpoint is valid but the
                 * resource itself does not exist. Servers may also send this response instead of 403
                 * Forbidden to hide the existence of a resource from an unauthorized client. This
                 * response code is probably the most well known due to its frequent occurrence on the web.
                 */
            case Response::HTTP_NOT_FOUND:
                $resPhrase = 'Not Found';
                $resStatus = 'fail';
                break;
                /**
                 * The request method is known by the server but is not supported by the target resource.
                 * For example, an API may not allow calling DELETE to remove a resource.
                 */
            case Response::HTTP_METHOD_NOT_ALLOWED:
                $resPhrase = 'Method Not Allowed';
                $resStatus = 'fail';
                break;

                /**
                 * This response is sent when the web server, after performing server-driven content
                 * negotiation, doesn't find any content that conforms to the criteria given by the
                 * user agent.
                 */
            case Response::HTTP_NOT_ACCEPTABLE:
                $resPhrase = 'Not Acceptable';
                $resStatus = 'fail';
                break;

                /**
                 * This is similar to 401 Unauthorized but authentication is needed to be done by a proxy.
                 */
            case Response::HTTP_PROXY_AUTHENTICATION_REQUIRED:
                $resPhrase = 'Proxy Authentication Required';
                $resStatus = 'fail';
                break;

                /**
                 * This response is sent on an idle connection by some servers, even without any previous
                 * request by the client. It means that the server would like to shut down this unused
                 * connection. This response is used much more since some browsers, like Chrome, Firefox 27+,
                 *  or IE9, use HTTP pre-connection mechanisms to speed up surfing. Also note that some
                 * servers merely shut down the connection without sending this message.
                 */
            case Response::HTTP_REQUEST_TIMEOUT:
                $resPhrase = 'Request Timeout';
                $resStatus = 'fail';
                break;

                /**
                 * This response is sent when a request conflicts with the current state of the server.
                 */
            case Response::HTTP_CONFLICT:
                $resPhrase = 'Conflict';
                $resStatus = 'fail';
                break;

                /**
                 * This response is sent when the requested content has been permanently deleted from server,
                 *  with no forwarding address. Clients are expected to remove their caches and links to the
                 * resource. The HTTP specification intends this status code to be used for "limited-time,
                 * promotional services". APIs should not feel compelled to indicate resources that have been
                 * deleted with this status code.
                 */
            case Response::HTTP_GONE:
                $resPhrase = 'Gone';
                $resStatus = 'fail';
                break;

                /**
                 * Server rejected the request because the Content-Length header field is not defined
                 * and the server requires it.
                 */
            case Response::HTTP_LENGTH_REQUIRED:
                $resPhrase = 'Length Required';
                $resStatus = 'fail';
                break;

                //Ok responses
            case Response::HTTP_OK:
                $resPhrase = 'Ok';
                $resStatus = 'success';
                break;
            case Response::HTTP_CREATED:
                $resPhrase = 'Created';
                $resStatus = 'success';
                break;
            case Response::HTTP_ACCEPTED:
                $resPhrase = 'Accepted';
                $resStatus = 'success';
                break;
            case Response::HTTP_NO_CONTENT:
                $resPhrase = 'No Content';
                $resStatus = 'success';
                break;

                //Server error codes
            case Response::HTTP_SERVICE_UNAVAILABLE:
                $resPhrase = 'Service Unavailable';
                $resStatus = 'fail';
                break;
            case Response::HTTP_INTERNAL_SERVER_ERROR:
                $resPhrase = 'Internal Server Error';
                $resStatus = 'fail';
                break;
            case Response::HTTP_NOT_IMPLEMENTED:
                $resPhrase = 'Not Implemented';
                $resStatus = 'fail';
                break;
            case Response::HTTP_BAD_GATEWAY:
                $resPhrase = 'Bad Gateway';
                $resStatus = 'fail';
                break;
            default:
                // code...
                break;
        }
        $response = [
            'resCode' => $code,
            'resPhrase' => $resPhrase,
            'resStatus' => $resStatus,
            'resMsg' => $msg,
            'data' => $data,
        ];

        return \response()->json($response, $code)
            ->header('Content-Type', 'application/json');
    }
}
